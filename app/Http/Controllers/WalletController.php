<?php

namespace App\Http\Controllers;

use Auth;
use Lang;
use PDF;
use Storage;
use Mail;
use App\Models\Wallet;
use App\Models\Bank;
use App\Models\Activity;
use App\Models\Transaction;
use App\Models\SnapTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Notifications\TransactionMail;

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

    public function create_withdraw($id, $token, $ip, $agent, $request, $user) {
        $invoice = Auth::user()->id . '/wallet/transactions/' . 'withdraw/' . date('Y-m') . '/withdraw-' . date('d') . '-' . $id .'.pdf';
        Transaction::create([
            'wal_transaction_id' =>  $id,
            'wal_reference_id' =>  $request['withdraw_from'],
            'wal_credited_wallet' => $user['wallet_id'],
            'wal_debited_wallet' => $user['wallet_id'],
            'wal_debited_bank' => $request['withdraw_to'],
            'wal_description' => $request['note'],
            'wal_amount' => preg_replace(['/[,.]/'],'',$request['amount']),
            'wal_transaction_type' => 'Penarikan',
            'wal_status' => 'pending',
            'wal_token' => $token,
            'wal_invoice' => $invoice,
        ]);
        Activity::create([
            'user_id' => Auth::user()->id,
            'activity' => Lang::get('activity.transaction.withdraw.' . $request['withdraw_from']),
            'ip_address' => $ip,
            'user_agent' => $agent,
        ]);
        $details = Transaction::where('wal_transaction_id', $id)->first();
        $pdf = PDF::loadview('exports.transaction', ['details' => $details])->setPaper('a4', 'potrait');
        Storage::put($invoice, $pdf->output());
        Auth::user()->notify(new TransactionMail($details));
    }

    public function withdraw(Request $request) {
        $user = WalletController::index()->balance;
        $id_transaction = date('Yhis').rand(0, 9999);
        $token = hash('sha512', $user->wallet_id . $id_transaction .'failed' . rand() . preg_replace(['/[,.]/'],'',$request->amount));
        $validator = Validator::make($request->all(), [
            'withdraw_from' => ['required', 'string'],
            'withdraw_to' => ['required', 'integer'],
            'amount' => ['required'],
        ]);
        if($validator->fails()) {
            return back()->with(['error' => Lang::get('validation.withdraw.required')]);
        }

        $ip = $request->ip();
        $agent = $request->userAgent();
        switch($request->withdraw_from) {
            case "pendapatan":
                if(($user->revenue < preg_replace(['/[,.]/'],'',$request->amount)) || ($user->revenue == 0)) {
                    return back()->with(['error'=> Lang::get('validation.balance')]);
                }

                WalletController::create_withdraw($id_transaction, $token, $ip, $agent, $request->all(), $user);

                Wallet::where('wallet_id', $user->wallet_id)->update([
                    'revenue' => $user->revenue - preg_replace(['/[,.]/'],'',$request->amount),
                    'balance' => $user->balance - preg_replace(['/[,.]/'],'',$request->amount),
                ]);

                return back()->with(['status' => Lang::get('validation.withdraw.revenue')]);
                break;

            case "dana":
                if(($user->fund < preg_replace(['/[,.]/'],'',$request->amount)) || ($user->fund == 0)) {
                    return back()->with(['error'=> Lang::get('validation.balance')]);
                }

                WalletController::create_withdraw($id_transaction, $token, $ip, $agent, $request->all(), $user);

                Wallet::where('wallet_id', $user->wallet_id)->update([
                    'fund' => $user->fund - preg_replace(['/[,.]/'],'',$request->amount),
                    'balance' => $user->balance - preg_replace(['/[,.]/'],'',$request->amount),
                ]);

                return back()->with(['status' => Lang::get('validation.withdraw.fund')]);
                break;

            case "saldo":
                if(($user->balance < preg_replace(['/[,.]/'],'',$request->amount)) || ($user->balance == 0)) {
                    return back()->with(['error'=> Lang::get('validation.balance')]);
                }

                WalletController::create_withdraw($id_transaction, $token, $ip, $agent, $request->all(), $user);

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

                return back()->with(['status' => Lang::get('validation.withdraw.balance')]);
                break;

            default:
                return back()->with(['error' => Lang::get('validation.withdraw.failed')]);
                break;
        }
    }

    public function send(Request $request) {
        $debited = Wallet::where('user_id', Auth::user()->id)->first();

        $validator = Validator::make($request->all(), [
            'transfer_to' => ['required', 'integer'],
            'amount' => ['required'],
        ]);

        if($validator->fails()) {
            return back()->with(['error' => Lang::get('validation.withdraw.required')]);
        } else if(($debited->fund < preg_replace(['/[,.]/'],'',$request->amount)) || ($debited->fund == 0)) {
            return redirect()->back()->with(['error'=> Lang::get('validation.fund')]);
        } else if($request->transfer_to == $debited->wallet_id) {
            return redirect()->back()->with(['error'=> Lang::get('validation.sendself')]);
        } else {
            $token = hash('sha512', $debited->wallet_id. date('Yhmdhis') . rand() .'failed'.preg_replace(['/[,.]/'],'',$request->amount));
            $id = date('Yhis').rand(0, 9999);
            $invoice = Auth::user()->id . '/wallet/transactions/' . 'transfer/' . date('Y-m') . '/transfer-' . date('d') . '-' . $id .'.pdf';
        $send = Transaction::create([
            'wal_transaction_id' =>  $id,
            'wal_reference_id' =>  'Dana',
            'wal_credited_wallet' => $debited->wallet_id,
            'wal_debited_wallet' => $request->transfer_to,
            'wal_description' => $request->note,
            'wal_amount' => preg_replace(['/[,.]/'],'',$request->amount),
            'wal_transaction_type' => 'Transfer',
            'wal_status' => 'failed',
            'wal_token' => $token,
            'wal_invoice' => $invoice,
        ]);
        $details = Transaction::where('wal_transaction_id', $id)->first();
        $pdf = PDF::loadview('exports.transaction', ['details' => $details])->setPaper('a4', 'potrait');
        Storage::put($invoice, $pdf->output());
        $url = 'http://localhost:8080/api/wallet/status/send';
        // $ch = curl_init($url);
        // $payload = json_encode(array($send));
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $result = curl_exec($ch);
        // curl_close($ch);
        $response = Http::put($url, array($send));
        // $response = Http::put('https://webhook.site/4c021b54-1fdf-4c96-a1e7-76dcfaa868e9', array($send));
        $details = Transaction::with('debitedwallet.walletusers')
        ->where('wal_transaction_id', $id)
        ->first();
        Auth::user()->notify(new TransactionMail($details));
        return redirect('/wallet/redirect/' . base64_encode($id) . '/' . 'transfer');
        }
    }

    public function redirectTransaction($id, $type) {
        $balance = Wallet::where('user_id', Auth::user()->id)->first();
        $details = Transaction::with('debitedwallet.walletusers')
        ->where('wal_transaction_id', base64_decode($id))
        ->orWhere('wal_debited_wallet', Auth::user()->id)
        ->orWhere('wal_credited_wallet', Auth::user()->id)
        ->first();
        return view('transaction-redirect', ['details' => $details, 'balance' => $balance]);
    }

    public function sendstatus(Request $request) {
        $data = $request->json()->all();
        $token = $data[0]['wal_token'];
        $id = $data[0]['wal_transaction_id'];
        $cre = Wallet::where('wallet_id', $data[0]['wal_credited_wallet'])->first();
        $status = Transaction::where('wal_transaction_id', $id)->first();
    if(($token == $status->wal_token) && ($data[0]['wal_status'] !== 'success') && $cre->fund >= $data[0]['wal_amount']) {
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
                'user_id' => $status->debitedwallet->walletusers->id,
                'activity' => Lang::get('activity.transaction.send.fund'),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
            $details = Transaction::where('wal_transaction_id', $id)->first();
            $pdf = PDF::loadview('exports.transaction', ['details' => $details])->setPaper('a4', 'potrait');
            Storage::put($status->debitedwallet->walletusers->id . '/wallet/transactions/' . 'transfer/' . date('Y-m') . '/transfer-' . date('d') . '-' . $id .'.pdf', $pdf->output());
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