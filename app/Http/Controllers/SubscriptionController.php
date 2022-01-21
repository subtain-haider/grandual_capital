<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Settings;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = Subscription::all();
        return view('admin.subscription.subscription',compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subscription.addsubscription');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {


        $subscription = new Subscription();

            if($request->file('image')) {
                $fileName = time() . $request->image->getClientOriginalName();
                $filePath = $request->file('image')->storeAs('subscriptions', $fileName, 'public');
                $subscription->image = $filePath;
            }

        $subscription->text = $request->text;
        $subscription->name = $request->name;
        $subscription->price = $request->price;
        $subscription->r_fee = $request->r_fee;
        $subscription->desc = $request->desc;
        $subscription->p_subscription = $request->p_subscription;
        $subscription->status = $request->status;
        $subscription->affiliate = $request->affiliate;
        $subscription->account = $request->account;
        $subscription->save();
        return redirect("admin/subscription");
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
        $subscription = Subscription::findOrFail($id);
        return view('admin.subscription.editsubscription',compact('subscription'));
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
        
        // dd("ok");
        $subscription = Subscription::where('id',$id)->first();
        if ($subscription->account != $request->account){
            $users = $subscription->users;
            foreach ($users as $user){
                $accounts = $user->accounts;
                if (count($accounts) > $request->account){
                    $del_accounts = $accounts->slice($request->account);
                    foreach ($del_accounts as $del){
                        $del->delete();
                    }
                }elseif (count($accounts) < $request->account){
                    $difference = $request->account - count($accounts) ;
                    for ($x=1; $x<=$difference; $x++){
                        $user->accounts()->create([
                            'number' => $x,
                            'subscription_id' => $user->p_subscription_id
                        ]);
                    }
                }
            }
            $accounts = Account::all();
            account_key_file($accounts);
            $subscription->account = $request->account;
        }
        if($request->file('image')) {
            $image_path = public_path('/').'/'.$subscription->image;
//            if (file_exists($image_path)) {
//                unlink($image_path);
//            }
            $fileName = time() . $request->image->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('subscriptions', $fileName, 'public');
            $subscription->image = $filePath;
        }
        $subscription->text = $request->text;
        $subscription->name = $request->name;
        $subscription->price = $request->price;
        $subscription->r_fee = $request->r_fee;
        $subscription->desc = $request->desc;
        $subscription->p_subscription = $request->p_subscription;
        $subscription->status = $request->status;
        $subscription->affiliate = $request->affiliate;



        $subscription->save();

        return redirect('admin/subscription');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);
        Account::where('subscription_id',$subscription->id)->delete();
        $subscription->delete();
        return redirect('admin/subscription');
    }

    public function paypal_modal($subscription_id){
        $subscription = Subscription::find($subscription_id);
        $p_subscription = $subscription->p_subscription;
        $setting = Settings::first();
        return view('admin.subscription.paypal',compact('p_subscription', 'setting'));
    }
}
