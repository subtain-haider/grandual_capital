<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use App\Models\WithdrawType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    public function user_withdraws(){
        $user = Auth::user();
        $withdraws = $user->withdraws;
        return view('user.withdraws.index', compact('withdraws'));
    }

    public function new_withdraws(){
        $type = WithdrawType::where('status',1)->get();
        return view('user.withdraws.create', compact('type'));
    }
    public function post_new_withdraws(Request $request){
        $user = Auth::user();
        if ($user->a_cash >= $request->amount){
            $user->withdraws()->create($request->except('_token'));
        }
        $amount = $user->a_cash - $request->amount;
        $user->update([
            'a_cash' => $amount
        ]);
        return redirect('/user/withdraws');
    }

    public function admin_withdraws(){
        $withdraws = Withdraw::get();
        return view('admin.withdraws.index', compact('withdraws'));
    }
    public function withdraw_approve($id){
        $withdraw = Withdraw::find($id);
        $withdraw->update([
            'status' => 1
        ]);
        return back();
    }
    public function withdraw_reject($id){
        $withdraw = Withdraw::find($id);
        $user = $withdraw->user;
        $amount = $user->a_cash + $withdraw->amount;
        $withdraw->user()->update([
            'a_cash' => $amount
        ]);
        $withdraw->delete();
        return back();
    }

    
    public function withdrawsTypes(){
        $type = WithdrawType::get();
        return view('admin.withdarws_type.index', compact('type'));
    }
    public function withdrawsTypesAdd(){
        return view('admin.withdarws_type.add');
    }
    public function withdrawsTypesdestroy($id)
    {
        $product = WithdrawType::findOrFail($id);
        $product->delete();
        return back();
    }
    public function withdrawsTypesstore(Request $request)
    {
        // dd($request);
        $category = new WithdrawType();
        $category->name = $request->category;
        $category->save();
        return back();
    }
    public function withdrawsTypesStatus(Request $request)
    {
        // dd($request);
        $product = WithdrawType::findOrFail($request->id);
        $product->status = $request->status;
        $product->save();
        return back();
    }
}
