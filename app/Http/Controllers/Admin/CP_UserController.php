<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\topic;
use App\Models\Post;
use App\Models\User;
use App\Models\Categories;
use App\Models\PollQuestion;
use App\Models\PollTaken;
use App\Models\Notification;
use App\Models\Ban;
use App\Models\BanTimes;
use App\Models\PMTopic;
use App\Models\Shortcuts;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Route;


class CP_UserController extends Controller
{
    public function Members (Request $request){
    
        if($user = Auth::user() && my('level') == 3)
        {
            $max_items_perpage = sys_info('cp_max_memberlist');
            $count = User::orderBy('id', 'asc')->get()->count();
            $users = User::orderBy('id', 'asc')->paginate($max_items_perpage);
            return view('admin.user.members', [
                'users' => $users,
                'max_perpage' => $max_items_perpage,
                'count' => $count
            ]);
        }
        else
        {
            return redirect()->route('home');
        }

    }

    public function MembersAdmins (Request $request){
    
        if($user = Auth::user() && my('level') == 3)
        {
            $max_items_perpage = sys_info('cp_max_memberlist');
            $count = User::where('level', 3)->orderBy('id', 'asc')->get()->count();
            $users = User::where('level', 3)->orderBy('id', 'asc')->paginate($max_items_perpage);
            return view('admin.user.members', [
                'users' => $users,
                'max_perpage' => $max_items_perpage,
                'count' => $count
            ]);
        }
        else
        {
            return redirect()->route('home');
        }

    }

    public function MembersModersGlobal (Request $request){
    
        if($user = Auth::user() && my('level') == 3)
        {
            $max_items_perpage = sys_info('cp_max_memberlist');
            $count = User::where('level', 2)->orderBy('id', 'asc')->get()->count();
            $users = User::where('level', 2)->orderBy('id', 'asc')->paginate($max_items_perpage);
            return view('admin.user.members', [
                'users' => $users,
                'max_perpage' => $max_items_perpage,
                'count' => $count
            ]);
        }
        else
        {
            return redirect()->route('home');
        }

    }

    public function MembersModers (Request $request){
    
        if($user = Auth::user() && my('level') == 3)
        {
            $max_items_perpage = sys_info('cp_max_memberlist');
            $count = User::where('level', 1)->orderBy('id', 'asc')->get()->count();
            $users = User::where('level', 1)->orderBy('id', 'asc')->paginate($max_items_perpage);
            return view('admin.user.members', [
                'users' => $users,
                'max_perpage' => $max_items_perpage,
                'count' => $count
            ]);
        }
        else
        {
            return redirect()->route('home');
        }

    }


    public function MembersDisabled (Request $request){
    
        if($user = Auth::user() && my('level') == 3)
        {
            $max_items_perpage = sys_info('cp_max_memberlist');
            $count = User::where('disable_account', 'on')->orderBy('id', 'asc')->get()->count();
            $users = User::where('disable_account', 'on')->orderBy('id', 'asc')->paginate($max_items_perpage);
            return view('admin.user.members', [
                'users' => $users,
                'max_perpage' => $max_items_perpage,
                'count' => $count
            ]);
        }
        else
        {
            return redirect()->route('home');
        }

    }

    public function MembersBanned(Request $request){
    
        if($user = Auth::user() && my('level') == 3)
        {
            $max_items_perpage = sys_info('cp_max_memberlist');
            $count = Ban::where([ ['banned_till', '>=', dayXnow()] ])->orderBy('id', 'asc')->get()->count();
            $users = Ban::where([ ['banned_till', '>=', dayXnow()] ])->orderBy('id', 'asc')->paginate($max_items_perpage);
            return view('admin.user.members', [
                'users' => $users,
                'max_perpage' => $max_items_perpage,
                'count' => $count
            ]);
        }
        else
        {
            return redirect()->route('home');
        }

    }
    
    public function MemberDelete(Request $request, $id){
        
        if($user = Auth::user() && my('level') == 3)
        {
            if(user_info($id, 'id') < 1)
            {
                return redirect()->route('dashboard');
            }

            if($request->isMethod('post'))
            {
                $this->validate($request, [
                    'agreeDeleteUser' => 'required'
                ]);
            
                if($request->post('agreeDeleteUser') == 'on')
                {
                    $queryDelete = User::where('id', $id)->delete();
                    if($queryDelete)
                    {
                        return redirect()->route('admin.members.all');
                    }
                }
            }  
            $query = User::where('id', $id)->limit(1)->get();
            return view('admin.user.delete', ['users' => $query, 'id' => $id]);
        }
        else
        {
            return redirect()->route('home');
        }
        
    }


}
