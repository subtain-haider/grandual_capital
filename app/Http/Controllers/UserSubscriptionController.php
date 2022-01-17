<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Affiliation;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = Subscription::all();
        $user =Auth::user();
        return view('user.subscription.subscription',compact('subscriptions', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function user_subscription($user_id, $subscription_id)
    {
       $user = User::find($user_id);
        $subscription = Subscription::find($subscription_id);
        $affiliation = Affiliation::first();

        $a_user = User::where('ref_id', $user->ref_by )->first();
        $a_user_sub = $a_user->subscription_id;
        // return $a_user_sub_check;
        if ($a_user_sub){
                $a_user_sub_check = Subscription::find($a_user_sub);
                $a_user_sub_A = $a_user_sub_check ->affiliate;
            if ($a_user_sub_A == "Yes") {
                $amount = ($subscription->price * $affiliation->percentage) / 100;
                $amount = $a_user->a_cash + $amount;
                $a_user->update([
                'a_cash' => $amount,
            ]);
            }
        }


        $expires_at = Carbon::now()->addMonths($subscription->name);

        $user->update([
            'p_subscription_id' => $subscription_id,
            'expires_at' => $expires_at->format('Y.m.d')
        ]);
//        $user->accounts()->delete();
        $subscription_accounts = $subscription->account;
        $user_accounts = count($user->accounts);
        if ($user_accounts < $subscription_accounts){
        $difference = $subscription_accounts - $user_accounts ;
            for ($x=1; $x<=$difference; $x++){
                $user->accounts()->create([
                    'number' => $x,
                    'subscription_id' => $user->p_subscription_id
                ]);
            }
        }elseif ($user_accounts > $subscription_accounts){
            $del_accounts = $user->accounts->slice($subscription_accounts);
            foreach ($del_accounts as $del){
                $del->delete();
            }
        }


        $accounts = Account::all();
        account_key_file($accounts);

        return back()->with('success', 'Subscription bought successfully.');
    }

    public function subscription_success(Request $request)
    {
        dd($request);
    }
}
