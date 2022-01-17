<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{

    public function user_accounts()
    {
        $user = Auth::user();
        return view('user.accounts.create', compact('user'));
    }
    public function admin_accounts()
    {
        $accounts = Account::all();
        return view('admin.account_numbers.index',compact('accounts'));
    }
    public function user_accounts_post(Request $request)
    {
        $account = Account::find($request->account_id);
        $account->update([
            'account' => $request->account
        ]);
        $accounts = Account::all();
        account_key_file($accounts);
        return back()->with('success', 'Account number updated successfully.');
    }
    public  function admin_account_edit($id){
        $account = Account::find($id);
        return view('admin.account_numbers.edit',compact('account'));
    }
    public function admin_account_update(Request $request){
        $account = Account::find($request->account_id);
        $account->update([
            'account' => $request->account
        ]);
        $accounts = Account::all();
        account_key_file($accounts);
        return redirect('/admin/admin_accounts');
    }

}
