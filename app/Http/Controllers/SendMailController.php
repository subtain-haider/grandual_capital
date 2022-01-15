<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\User;

use Mail;


class SendMailController extends Controller

{

    public function index()

    {
        
    	$contactName = 'John doe';
        $contactEmail = 'info@laravel.me';
        $contactMessage = 'I need a doctor Dre';

        $data = array('name'=>$contactName, 'email'=>$contactEmail, 'pass'=>$contactMessage);
        Mail::send('email.view2', $data, function($message) use ($contactEmail, $contactName)
        {   
            $message->from($contactEmail, $contactName);
            $message->to('qimadze.amiran@gtu.ge', 'myName')->subject('Mail via aallouch.com');
        });

    	dd('Mail Send Successfully');
      
    }

    

}

