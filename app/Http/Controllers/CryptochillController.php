<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CryptochillController extends Controller
{
    public function cryptochill(Request $request)
    {
        if ($request->callback_status == 'transaction_confirmed' || $request->callback_status == 'transaction_complete') {



            $invoice = $request->transaction['invoice'];
            $investment = Investment::find($invoice['passthrough']);

            if ($investment->status != 'confirmed') {
                $investment->update(['status' => 'confirmed']);
                if ($investment->upgraded_from) {
                    $old_investment = Investment::find($investment->upgraded_from);
                    $total_cost = $investment->tier->cost - $old_investment->tier->cost;
                    $total_fee = $investment->tier->fee - $old_investment->tier->fee;
                } else {
                    $total_cost = $investment->tier->cost;
                    $total_fee = $investment->tier->fee;
                }

                $a_cc = ($total_cost + $total_fee) - ($investment->tier->cost * 1) / 100;
                $a_ref = ($a_cc * $investment->tier->referral) / 100;
                $a_admin = ($a_cc * $investment->tier->admin) / 100;

                $user = $investment->customer;
                $ref_user = Customer::where('ref_id', $user->ref_by)->first();

                $admin = User::where('is_admin', 1)->first();

                $recipients = [];
                array_push($recipients, [
                    'amount' => $a_admin,
                    'currency' => 'USD',
                    'address' => $admin->bitcoin,
                    'notes' => 'Admin Fee',
                ]);
                if ($ref_user) {
                    array_push($recipients, [
                        'amount' => $a_ref,
                        'currency' => 'USD',
                        'address' => $ref_user->bitcoin,
                        'notes' => 'Referral Bonus',
                    ]);
                }
                $payload = [
                    'profile_id' => env('c_profile_id'),
                    'network_fee_preset' => 'high',
                    'passthrough' => $investment->id . '',
                    'recipients' => $recipients,
                ];
                $response = Helper::cryptochill_api_request('payouts', $payload, 'POST');

                if ($response->failed()) {
                    $error = $response->json();
                    if ($error['reason'] == 'InsufficientFunds') {
                        DB::table('failedpayouts')->insert([
                            'payload' => serialize($recipients),
                            'type' => 'income',
                        ]);
                    }
                }
            }
        }
    }
}
