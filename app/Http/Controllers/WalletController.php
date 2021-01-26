<?php

namespace App\Http\Controllers;

use Auth;
use Lang;
use App\Models\Wallet;
use App\Models\Bank;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class WalletController extends Controller
{

    public function index() {
        $balance = Wallet::where('user_id', Auth::user()->id)->first();
        $bank = Bank::where('user_id', Auth::user()->id)->get();
        $credited = Transaction::with('creditedwallet.walletusers')
        ->where('wal_credited_wallet', $balance->wallet_id)
        ->with('debitedwallet.walletusers')
        ->Orwhere('wal_debited_wallet', $balance->wallet_id)
        ->orderBy('created_at', 'DESC')
        ->get();
        return view('wallet', ['balance' => $balance, 'bank' => $bank, 'credited' => $credited]);
        // return response()->json($credited);
    }
    public function transdetails(Request $request) {
        $transaction = Transaction::with('creditedwallet.walletusers')
        ->where('wal_transaction_id', $request->trans_id)
        ->with('debitedwallet.walletusers')
        ->Orwhere('wal_transaction_id', $request->trans_id)
        ->first();
        return response()->json($transaction);
    }

    public function deletebank($id) {
        $transaction = Bank::where('bank_id', $id)->delete();
        return back()->with(['status' => Lang::get('validation.deletebank')]);
    }
    public function addbank(Request $request) {

        $validator = Validator::make($request->all(), [
            'bank_code' => ['required', 'string'],
            'bank_user' => ['required', 'string', 'max:255'],
            'bank_account' => ['required', 'string'],
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator->messages());
        }

        Bank::create([
            'user_id' => Auth::user()->id,
            'bank_user' => $request->bank_user,
            'bank_account' => base64_encode($request->bank_account),
            'bank_code' => $request->bank_code,
        ]);
        return back()->with(['status' => Lang::get('validation.addbank')]);
    }

    public function cekminimum(Request $request) {
        if($request->amount < 10000) {
            return response()->json(['error'=> Lang::get('validation.balanceminimal'), 'statuscode'=> 400]);
        } else {
            return response()->json(['statuscode'=> 200]);
        }
    }

    public function cekdana(Request $request) {
        $credited = Wallet::where('user_id', Auth::user()->id)->first();
        if(($credited->fund < preg_replace(['/[,.]/'],'',$request->amount)) || ($credited->fund == 0)) {
            return response()->json(['error'=> Lang::get('validation.balance'), 'statuscode'=> 400]);
        } else {
            return response()->json(['statuscode'=> 200]);
        }
    }
    public function cekpendapatan(Request $request) {
        $credited = Wallet::where('user_id', Auth::user()->id)->first();
        if(($credited->revenue < preg_replace(['/[,.]/'],'',$request->amount)) || ($credited->revenue == 0)) {
            return response()->json(['error'=> Lang::get('validation.balance'), 'statuscode'=> 400]);
        } else {
            return response()->json(['statuscode'=> 200]);
        }
    }
    public function cekbalance(Request $request) {
        $credited = Wallet::where('user_id', Auth::user()->id)->first();
        if(($credited->balance < preg_replace(['/[,.]/'],'',$request->amount)) || ($credited->balance == 0)) {
            return response()->json(['error'=> Lang::get('validation.balance'), 'statuscode'=> 400]);
        } else {
            return response()->json(['statuscode'=> 200]);
        }
    }

    public function cekuser(Request $request) {
        $debited = Wallet::with('walletusers')->where('wallet_id', $request->wallet_id)->first();
        //return response()->json($debited->walletusers['name']);
        if(!$debited) {
            return response()->json(['status'=> Lang::get('validation.balance'), 'statuscode'=> 400]);
        } else {
            return response()->json(['status'=> $debited->walletusers['name'] . ' - ' . $debited->wallet_id, 'statuscode'=> 200]);
        }
    }

    public function withdraw() {
        $withdraw = Wallet::where('user_id', Auth::user()->id)->first();
        
    }

    public function send(Request $request) {
        $debited = Wallet::where('user_id', Auth::user()->id)->first();
        if($debited->fund < preg_replace(['/[,.]/'],'',$request->amount)) {
            return redirect()->back()->with(['error'=> Lang::get('validation.balance')]);
        } else {

        $token = hash('sha512', $debited->wallet_id.'pending'.preg_replace(['/[,.]/'],'',$request->amount));
        $send = Transaction::create([
            'wal_transaction_id' =>  date('mdhi').rand(),
            'wal_reference_id' =>  'EXOVA BANK',
            'wal_credited_wallet' => $debited->wallet_id,
            'wal_debited_wallet' => $request->transfer_to,
            'wal_description' => $request->note,
            'wal_amount' => preg_replace(['/[,.]/'],'',$request->amount),
            'wal_transaction_type' => 'TRANSFER',
            'wal_status' => 'pending',
            'wal_token' => $token,
        ]);

        $url = 'http://localhost:8080/api/wallet/status/send';
        $ch = curl_init($url);
        $payload = json_encode(array($send));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        //$response = Http::post('http://localhost:8080/api/wallet/status/send', array($send));
        return redirect()->back();
        }
    }
    public function sendstatus(Request $request) {
        $data = $request->json()->all();
        $token = $data[0]['wal_token'];
        $id = $data[0]['wal_transaction_id'];
        $status = Transaction::where('wal_transaction_id', $id)->first();
    if(($token == $status->wal_token) && ($data[0]['wal_token'] !== 'success')) {
            Transaction::where('wal_transaction_id', $id)->update([
                'wal_status' => 'success',
                'wal_token' => $token,
            ]);
            $debited = Wallet::where('wallet_id', $data[0]['wal_debited_wallet'])->first();
            $credited = Wallet::where('wallet_id', $data[0]['wal_credited_wallet'])->first();
            Wallet::where('wallet_id', $data[0]['wal_credited_wallet'])->update([
                'fund' => $credited->fund - $data[0]['wal_amount'],
                'balance' => $credited->balance - $data[0]['wal_amount'],
            ]);
            Wallet::where('wallet_id', $data[0]['wal_debited_wallet'])->update([
                'fund' => $debited->fund + $data[0]['wal_amount'],
                'balance' => $debited->balance + $data[0]['wal_amount'],
            ]);
        }
    }
}