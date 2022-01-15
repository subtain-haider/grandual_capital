<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Auth::user();
        return view('user.profile.profile',compact('profile'));
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
        if($request->email != Auth::user()->email)
        {
            $request->validate(['email'=>'unique:users']);
        }
        $user_id = Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        $user->full_name = $request->full_name;
        $user->name = $request->name;
        if($request->image){
            if($user->image != null)
            {
                $image_path = public_path('storage/users/').$user->image;
                unlink($image_path);
            }
                $name = time() .'.'. $request->image->extension();
                $store = $request->image->storeAs('public/users/',$name);
                $user->image=$name;
                // $user->save();
          }
        if($request->old_password)
        {
        $response = Hash::check($request->old_password, $user->password);
        if($response == true)
        {
            $hashPassword = Hash::make($request->new_password);
            $user->password = $request->hashPassword;
        }
        }
        $user->save();
        return redirect()->back();
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
}
