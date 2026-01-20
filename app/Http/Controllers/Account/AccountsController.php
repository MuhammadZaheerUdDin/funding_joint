<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Admin\AdminTransactionsController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Requests\Transaction\TransactionRequest;
use App\Http\Requests\Transaction\TransactionWithdrawRequest;
use App\Model\AccountBalance;
use App\Model\Transaction;
use App\Notifications\AdminNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountsController extends Controller
{

    public function show()
    {
        $request = Request::capture();
        $user = Auth::user();
        if($user->getRole() =="admin")
            return redirect()->route('dashboard');
        
        $account = AccountBalance::where('user_id', $user->id)->first();
        $transactionsOrder = $request->SortBy ==='oldest' ? 'ASC' : 'DESC';
        $transactions = $user->transactions()->orderby('created_at', $transactionsOrder)->get();

        $newreference = AdminTransactionsController::createReference($user->id);



       // dd($user->bankDetails()->get());

        // dd($account, $transactions, $newreference);

        return view('investor.account', compact(['user', 'account', 'transactions', 'newreference']));

    }


    public function requestDepositFunds(TransactionRequest $request)
    {
        $amount = $request->amount;

        $user = Auth::user();

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'description' => 'Added to my Wallet',
            'amount' => $amount,
            'type' => 'credit',
            'remarks' => '',
            'reference' => $request->reference
        ]);

        $this->sendDepositRequestNotificationFor($transaction);
        return redirect()->back()->with('msg', 'Funds requested, You will get a notification once we receive and confirm the funds,');
    }


    public function requestWithdrawFunds(TransactionWithdrawRequest $request)
    {
        $amount = $request->amount;

        $user = Auth::user();
        $reference = $request->reference ? $request->reference : AdminTransactionsController::createReference($user->id);
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'description' => 'Withdrawal',
            'amount' => $amount,
            'remarks' => 'Withdrawal',
            'type' => Transaction::DEBIT,
            'reference' => $reference
        ]);

        $this->sendWithdrawRequestNotificationFor($transaction);

        return redirect()->back()->with('msg', 'Funds Withdraw requested, You will get a notification once we confirm release of the funds,');
    }

    public function sendWithdrawRequestNotificationFor($transaction)
    {
        $user = Auth::user();
        $not_body = ucfirst($user->getRole()) . '- ' . $user->email . ' Requested to withdraw funds, review and confirm';
        $not_link = route('admin.transactions', ['id' => $transaction->id]);
        $notification = new AdminNotification('User Withdraws Funds', $not_body, $not_link);
        NotificationsController::sendToAdmins($notification);
    }


    public function sendDepositRequestNotificationFor($transaction)
    {
        $user = Auth::user();
        $not_body = ucfirst($user->getRole()) . '- ' . $user->email . ' added funds, review and confirm';
        $not_link = route('admin.transactions', ['id' => $transaction->id]);
        $notification = new AdminNotification('User Added Funds', $not_body, $not_link);
        NotificationsController::sendToAdmins($notification);
    }


}
