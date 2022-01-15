<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class AttachController extends Controller
{
    function action(Request $request)
    {

        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
        ]);
    
        $fileName = time().'.'.$request->file->getClientOriginalExtension(); //extension();  
        
        $request->file->move(public_path('images'), $fileName);
    
        return $fileName; 

    }

}
