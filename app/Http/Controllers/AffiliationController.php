<?php

namespace App\Http\Controllers;

use App\Models\Affiliation;
use Illuminate\Http\Request;

class AffiliationController extends Controller
{
    public function affiliation()
    {
        $affiliation = Affiliation::first();
        return view('admin.affiliation.addaffiliation', compact('affiliation'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $affiliation = Affiliation::first();
        $affiliation->percentage	 = $request->percentage	;
        $affiliation->recurring = $request->recurring ;
        $affiliation->update();
        return redirect()->back();
    }
}
