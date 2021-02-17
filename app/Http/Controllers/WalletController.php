<?php

namespace App\Http\Controllers;

use Auth;
use Lang;
use PDF;
use App\Models\Wallet;
use App\Models\Bank;
use App\Models\Activity;
use App\Models\Transaction;
use App\Models\SnapTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class WalletController extends Controller
{
    public static function index() {
        $balance = Wallet::where('user_id', Auth::user()->id)->first();
        $bank = Bank::where('user_id', Auth::user()->id)->get();
        $bankscount = Bank::where('user_id', Auth::user()->id)->count();
        $credited = Transaction::with('creditedwallet.walletusers')
        ->where('wal_credited_wallet', $balance->wallet_id)
        ->with('debitedwallet.walletusers')
        ->Orwhere('wal_debited_wallet', $balance->wallet_id)
        ->with('withdraw')
        ->orderBy('created_at', 'DESC')
        ->get();
        return view('wallet', ['balance' => $balance, 'bank' => $bank, 'credited' => $credited, 'bankscount' => $bankscount]);
       // return response()->json($credited);
    }
    public function transdetails(Request $request) {
        $transaction = Transaction::with('creditedwallet.walletusers')
        ->where('wal_transaction_id', $request->trans_id)
        ->with('debitedwallet.walletusers')
        ->Orwhere('wal_transaction_id', $request->trans_id)
        ->with('withdraw')
        ->first();
        return response()->json($transaction);
    }

    public function deletebank(Request $request, $id) {
        $transaction = Bank::where('bank_id', $id)->delete();
        Activity::create([
            'activity_id' => date('Ymdhis').rand(0, 1000),
            'user_id' => Auth::user()->id,
            'activity' => Lang::get('activity.bank.delete'),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
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
        Activity::create([
            'activity_id' => date('Ymdhis').rand(0, 1000),
            'user_id' => Auth::user()->id,
            'activity' => Lang::get('activity.bank.add'),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
        return back()->with(['status' => Lang::get('validation.addbank')]);
    }

    public function cekminimum(Request $request) {
        if(preg_replace(['/[,.]/'],'',$request->amount) < 10000) {
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
        $credited = WalletController::index()->balance;
        //return response()->json($debited->walletusers['name']);
        if($request->wallet_id == $credited->wallet_id) {
            return response()->json(['status'=> Lang::get('validation.sendself'), 'statuscode'=> 400]);
        } else if(!$debited) {
            return response()->json(['status'=> Lang::get('validation.usernotfound'), 'statuscode'=> 400]);
        } else {
            return response()->json(['status'=> $debited->walletusers['name'] . ' - ' . $debited->wallet_id, 'statuscode'=> 200]);
        }
    }

    public function withdraw(Request $request) {
        $user = WalletController::index()->balance;
        $id_transaction = date('mdhi').rand();
        $token = hash('sha512', $user->wallet_id.'pending'.preg_replace(['/[,.]/'],'',$request->amount));
        $validator = Validator::make($request->all(), [
            'withdraw_from' => ['required', 'string'],
            'withdraw_to' => ['required', 'integer'],
            'amount' => ['required'],
        ]);
        if($validator->fails()) {
            return back()->with(['error' => Lang::get('validation.withdraw.required')]);
        }
        switch($request->withdraw_from) {
            case "pendapatan":
                if(($user->revenue < preg_replace(['/[,.]/'],'',$request->amount)) || ($user->revenue == 0)) {
                    return back()->with(['error'=> Lang::get('validation.balance')]);
                }
                Transaction::create([
                    'wal_transaction_id' =>  $id_transaction,
                    'wal_reference_id' =>  'Pendapatan',
                    'wal_credited_wallet' => $user->wallet_id,
                    'wal_debited_wallet' => $user->wallet_id,
                    'wal_debited_bank' => $request->withdraw_to,
                    'wal_description' => $request->note,
                    'wal_amount' => preg_replace(['/[,.]/'],'',$request->amount),
                    'wal_transaction_type' => 'WITHDRAW',
                    'wal_status' => 'pending',
                    'wal_token' => $token,
                ]);
                SnapTransaction::create([
                    'snap_transaction_id' =>  $id_transaction,
                    'snap_reference_id' =>  'Pendapatan',
                    'snap_credited_wallet' => $user->wallet_id,
                    'snap_debited_wallet' => $user->wallet_id,
                    'snap_debited_bank' => $request->withdraw_to,
                    'snap_description' => $request->note,
                    'snap_amount' => preg_replace(['/[,.]/'],'',$request->amount),
                    'snap_transaction_type' => 'WITHDRAW',
                    'snap_status' => 'pending',
                    'snap_token' => $token,
                ]);
                Wallet::where('wallet_id', $user->wallet_id)->update([
                    'revenue' => $user->revenue - preg_replace(['/[,.]/'],'',$request->amount),
                    'balance' => $user->balance - preg_replace(['/[,.]/'],'',$request->amount),
                ]);
                Activity::create([
                    'activity_id' => date('Ymdhis').rand(0, 1000),
                    'user_id' => Auth::user()->id,
                    'activity' => Lang::get('activity.transaction.withdraw.revenue'),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
                // $response = Http::post('http://localhost:8080/api/withdraw/status/send', array($withdraw));
                return back()->with(['status' => Lang::get('validation.withdraw.revenue')]);
                //return response()->json($withdraw);
                break;

            case "dana":
                if(($user->fund < preg_replace(['/[,.]/'],'',$request->amount)) || ($user->fund == 0)) {
                    return back()->with(['error'=> Lang::get('validation.balance')]);
                }
                Transaction::create([
                    'wal_transaction_id' =>  $id_transaction,
                    'wal_reference_id' =>  'Dana',
                    'wal_credited_wallet' => $user->wallet_id,
                    'wal_debited_wallet' => $user->wallet_id,
                    'wal_debited_bank' => $request->withdraw_to,
                    'wal_description' => $request->note,
                    'wal_amount' => preg_replace(['/[,.]/'],'',$request->amount),
                    'wal_transaction_type' => 'WITHDRAW',
                    'wal_status' => 'pending',
                    'wal_token' => $token,
                ]);
                SnapTransaction::create([
                    'snap_transaction_id' =>  $id_transaction,
                    'snap_reference_id' =>  'Dana',
                    'snap_credited_wallet' => $user->wallet_id,
                    'snap_debited_wallet' => $user->wallet_id,
                    'snap_debited_bank' => $request->withdraw_to,
                    'snap_description' => $request->note,
                    'snap_amount' => preg_replace(['/[,.]/'],'',$request->amount),
                    'snap_transaction_type' => 'WITHDRAW',
                    'snap_status' => 'pending',
                    'snap_token' => $token,
                ]);
                Wallet::where('wallet_id', $user->wallet_id)->update([
                    'fund' => $user->fund - preg_replace(['/[,.]/'],'',$request->amount),
                    'balance' => $user->balance - preg_replace(['/[,.]/'],'',$request->amount),
                ]);
                Activity::create([
                    'activity_id' => date('Ymdhis').rand(0, 1000),
                    'user_id' => Auth::user()->id,
                    'activity' => Lang::get('activity.transaction.withdraw.fund'),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
                return back()->with(['status' => Lang::get('validation.withdraw.fund')]);
                break;

            case "balance":
                if(($user->balance < preg_replace(['/[,.]/'],'',$request->amount)) || ($user->balance == 0)) {
                    return back()->with(['error'=> Lang::get('validation.balance')]);
                }
                Transaction::create([
                    'wal_transaction_id' =>  $id_transaction,
                    'wal_reference_id' =>  'Balance',
                    'wal_credited_wallet' => $user->wallet_id,
                    'wal_debited_wallet' => $user->wallet_id,
                    'wal_debited_bank' => $request->withdraw_to,
                    'wal_description' => $request->note,
                    'wal_amount' => preg_replace(['/[,.]/'],'',$request->amount),
                    'wal_transaction_type' => 'WITHDRAW',
                    'wal_status' => 'pending',
                    'wal_token' => $token,
                ]);
                SnapTransaction::create([
                    'snap_transaction_id' =>  $id_transaction,
                    'snap_reference_id' =>  'Balance',
                    'snap_credited_wallet' => $user->wallet_id,
                    'snap_debited_wallet' => $user->wallet_id,
                    'snap_debited_bank' => $request->withdraw_to,
                    'snap_description' => $request->note,
                    'snap_amount' => preg_replace(['/[,.]/'],'',$request->amount),
                    'snap_transaction_type' => 'WITHDRAW',
                    'snap_status' => 'pending',
                    'snap_token' => $token,
                ]);
                $fund = $user->fund - preg_replace(['/[,.]/'],'',$request->amount);
                $sisafund = $fund;
                if($sisafund <= 0) {
                    $sisafund = 0;
                } else {
                    $fund = 0;
                }
                $revenue = $user->revenue + $fund;
                $balance = $sisafund + $revenue;
                Wallet::where('wallet_id', $user->wallet_id)->update([
                    'fund' => $sisafund,
                    'revenue' => $revenue,
                    'balance' => $balance,
                ]);
                Activity::create([
                    'activity_id' => date('Ymdhis').rand(0, 1000),
                    'user_id' => Auth::user()->id,
                    'activity' => Lang::get('activity.transaction.withdraw.balance'),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
                return back()->with(['status' => Lang::get('validation.withdraw.balance')]);
                break;

            default:
                return back()->with(['error' => Lang::get('validation.withdraw.failed')]);
                break;

        }
    }

    public function send(Request $request) {
        $debited = Wallet::where('user_id', Auth::user()->id)->first();
        if(($debited->fund < preg_replace(['/[,.]/'],'',$request->amount)) || ($debited->fund == 0)) {
            return redirect()->back()->with(['error'=> Lang::get('validation.fund')]);
        } else if($request->transfer_to == $debited->wallet_id) {
            return redirect()->back()->with(['error'=> Lang::get('validation.sendself')]);
        } else {

        $token = hash('sha512', $debited->wallet_id.'pending'.preg_replace(['/[,.]/'],'',$request->amount));
        $send = Transaction::create([
            'wal_transaction_id' =>  date('mdhi').rand(),
            'wal_reference_id' =>  'Dana',
            'wal_credited_wallet' => $debited->wallet_id,
            'wal_debited_wallet' => $request->transfer_to,
            'wal_description' => $request->note,
            'wal_amount' => preg_replace(['/[,.]/'],'',$request->amount),
            'wal_transaction_type' => 'TRANSFER',
            'wal_status' => 'pending',
            'wal_token' => $token,
        ]);

        $url = 'http://localhost:8080/api/wallet/status/send';
        // $ch = curl_init($url);
        // $payload = json_encode(array($send));
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $result = curl_exec($ch);
        // curl_close($ch);
        $response = Http::put('http://localhost:8080/api/wallet/status/send', array($send));
        return redirect()->back();
        }
    }
    public function sendstatus(Request $request) {
        $data = $request->json()->all();
        $token = $data[0]['wal_token'];
        $id = $data[0]['wal_transaction_id'];
        $status = Transaction::where('wal_transaction_id', $id)->first();
    if(($token == $status->wal_token) && ($data[0]['wal_status'] !== 'success')) {
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
            Activity::create([
                'activity_id' => date('Ymdhis').rand(0, 1000),
                'user_id' => Auth::user()->id,
                'activity' => Lang::get('activity.transaction.send.fund'),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }
    }


    public function export_history(Request $request) {
        $data = WalletController::index()->credited;
        $wallet = WalletController::index()->balance;
        $credited = Transaction::with('creditedwallet.walletusers')
        ->where('wal_credited_wallet', $wallet->wallet_id)
        ->count();
        $debited = Transaction::with('debitedwallet.walletusers')
        ->where('wal_debited_wallet', $wallet->wallet_id)
        ->count();
        $debitedBank = Transaction::with('debitedwallet.walletusers')
        ->where('wal_debited_wallet', $wallet->wallet_id)
        ->where('wal_credited_wallet', $wallet->wallet_id)
        ->count();
        $debited = $debited - $debitedBank;
        $pdf = PDF::loadview('pdf.trans_history', ['history' => $data, 'wallet' => $wallet,
        'credited' => $credited, 'debited' => $debited])->setPaper('a4', 'landscape');
        Activity::create([
            'activity_id' => date('Ymdhis').rand(0, 1000),
            'user_id' => Auth::user()->id,
            'activity' => Lang::get('activity.transaction.history.download'),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
        return $pdf->download(Lang::get('wallet.history.title').'.pdf');
        //return response()->json($data);
        // return view('/pdf.trans_history', ['history' => $data, 'wallet' => $wallet,
        // 'credited' => $credited, 'debited' => $debited]);
    }
    // public function tests(Request $request) {
    //     $data = array([
    //         $request->userAgent(),
    //         $request->ip(),
    //     ]);
    //     return response()->json($data);
    // }

}