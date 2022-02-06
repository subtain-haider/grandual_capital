<?php

namespace App\Http\Controllers;

use App\Models\Front;
use Illuminate\Http\Request;

class CryptochillController extends Controller
{
    public function cryptochill(Request $request)
    {
        if ($request->callback_status == 'invoice_pending') {
            $invoice = $request->invoice;
            $front = Front::first();
            $front->update(['top_header' => $invoice['passthrough']]);

            return true;
        }
        if ($request->callback_status == 'transaction_pending') {
            $invoice = $request->transaction['invoice'];
            $front = Front::first();
            $front->update(['top_sub_header' => $invoice['passthrough']]);
            return true;
        } elseif ($request->callback_status == 'transaction_confirmed' || $request->callback_status == 'transaction_complete') {
            $invoice = $request->transaction['invoice'];
            $front = Front::first();


            $data = explode(',',$invoice['passthrough']);
            $front->update(['header_image' => $data[1]]);
            $front->update(['how_it_works' => $data[0]]);

            user_subscribe_helper($data[1], $data[0]);
            return true;
        }
    }
}
