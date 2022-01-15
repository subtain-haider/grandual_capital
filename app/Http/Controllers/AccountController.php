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
        $file = public_path('/')."/accountDetail.key";
        $account = Account::find($request->account_id);
        $txt = $account->account.':GrandeurCapital'.'@'.date('Y.m.d').'.'.$account->user->email;
        if( strpos(file_get_contents("$file"),$txt) !== false) {
            // do stuff
            $new_txt = $request->account.':GrandeurCapital'.'@'.date('Y.m.d').'.'.$account->user->email;
            file_put_contents($file,str_replace($txt,$new_txt,file_get_contents($file)));
        }else{
            $file_content = file_get_contents($file);
            $txt = $file_content."\n" . $request->account.':GrandeurCapital'.'@'.date('Y.m.d').'.'.$account->user->email;
            file_put_contents($file,$txt);
        }
        $account->update([
            'account' => $request->account
        ]);
        return back()->with('success', 'Account number updated successfully.');
    }

}
