<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProductController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $products = Product::get();
        return view('user.product.product',compact( 'products'));
    }


}
