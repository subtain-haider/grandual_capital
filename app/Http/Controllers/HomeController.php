<?php

namespace App\Http\Controllers;

use App\Models\Affiliation;
use App\Models\Category;
use App\Models\Product;
use App\Models\Settings;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }
    public function group_chat()
    {
        return view('admin.chat.conversations');
    }
    public function group_meetings()
    {
        return view('admin.chat.meetings');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::where('featured',1)->get();
        $categories = Category::get();
        $subscriptions = Subscription::where('status', 1)->get();
        return view('front.new_home',compact('products', 'categories', 'subscriptions'));
    }

    public function adminHome()
    {
        $users = count(User::where('is_admin','!=',1)->get());
        $subscriptions = count(Subscription::all());
        $affiliations = count(Affiliation::all());
        return view('adminhome',compact('users','subscriptions','affiliations'));
    }
    public function userDashboard()
    {
        $user = Auth::user();
        $affiliations = User::where('ref_by', $user->ref_id)->get();
        return view('dashboard', compact('user', 'affiliations'));
    }

    public function bitcoin_success(Request $request){
        $user = Auth::user();
        return redirect('/user/subscribe/'.$user->id.'/'.$request->id);
    }

    public function setting_update(Request $request){
        $setting = Settings::first();
        $setting->update($request->except('_token'));
        return back();
    }

    public function checkoutsession(Request $request){
        $subscription = Subscription::find($request->subscription_id);

        $data = array();

        $data['price_data']['currency'] = 'usd';
        $data['price_data']['unit_amount'] = $subscription->price * 100;
        $data['price_data']['product_data']['name'] = $subscription->name . ' Months';

        $data['quantity'] = 1;

        \Stripe\Stripe::setApiKey(\App\Models\Settings::first()->s_secret);
        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                $data
            ],
            'mode' => 'payment',
            'success_url' =>  url('/').'/subscription_success?subscription_id='.$request->subscription_id,
            'cancel_url' => url('/').'/subscription_cancel',
        ]);

        return json_encode(['id' => $checkout_session->id]);
    }

    public function subscription_success(Request $request){
        $user = Auth::user();
        return redirect('/user/subscribe/'.$user->id.'/'.$request->subscription_id);

    }
}
