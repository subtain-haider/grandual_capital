<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use App\Models\Shortcuts;
use App\Models\PMTopic;
use App\Models\PMPost;
use App\Models\PMSmiles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Mail;

class MyController extends Controller
{

    public function settings(Request $request, $subpage=null)
    {

        $success_msg = '';
        $warrning_msg = '';
        
        if($user = Auth::user())
        { //if user logged in
            
            if ($request->isMethod('post'))
            {   
                //if editiong user info
                if($subpage=='')
                {
                    $this->validate($request, [
                        'name' => 'required|max:80',
                        'username' => 'required|max:20',
                        'sex' => 'required|min:1|max:1',
                        'address' => 'max:200',
                        'profeesion' => 'max:100',
                        'social_msg' => 'max:500'
                    ]);
                
                    //Insert genera info
                    $my_info = [
                        'full_name' => $request->post('name'),
                        'name' => $request->post('username'),
                        'gender' => $request->post('sex'),
                        'location' => $request->post('address'),
                        'profession' => $request->post('profeesion'),
                        'social_msg' => $request->post('social_msg')
                    ];

                    $update_myinfo = User::where('id', myid())->update($my_info);
                    if($update_myinfo)
                    {
                        $success_msg = 'User info updated successfully';
                    }
                    else
                    {   
                        $warrning_msg = 'Operation failed, We are sorry about. Please try again later.';
                    }

                }
                elseif($subpage=='account')
                {   
                    $this->validate($request, [
                        'email' => 'required|min:6',
                        'password' => 'required|min:6'
                    ]);

                    $oldPassword = $request->post('password');
                    $hashedPassword = Auth::user()->password;
                    $CurrentEmail = my('email');
            
                    if (Hash::check($oldPassword, $hashedPassword))
                    {
                        $new_password = $request->post('newpassword');
                        $repeat_password = $request->post('repeatpassword');
                        
                        if(!empty($new_password) && $new_password == $repeat_password)
                        {
                            $user = User::find(Auth::user()->id)->update(['email' => $request->post('email'),'password'=> Hash::make($new_password)]);
                            if($user)
                            {   
                                $to_name = my('name');
                                $to_email = $request->post('email');

                                $data = array('name'=>$to_name, 'email'=>$to_email, 'pass'=>$new_password);
                                Mail::send('email.view', $data, function($message) use ($to_email, $to_name)
                                {   
                                    $message->to($to_email, $to_name)->subject('Your password has been changed');
                                });
       
                                Auth::logout();
                                return redirect()->route('home');
                            }
                            else
                            {
                                $warrning_msg = 'Password couldn`t change, We are sorry about. Please try again later.';
                            }
                        }
                        else
                        {
                            if(empty($new_password) && $CurrentEmail != $request->post('email')){
                                $user = User::find(Auth::user()->id)->update(['email' => $request->post('email')]);
                                if($user)
                                {
                                    $success_msg = 'User email updated successfully';
                                }
                                else
                                {
                                    $warrning_msg = 'Email couldn`t change, We are sorry about. Please try again later.';
                                }
                            }
                            else
                            {
                                $warrning_msg = 'You couldn`t confirm password. Try again.';
                            }
                            
                        }
                        
                    }

                }
                elseif($subpage=='shortcuts')
                {
                    $user = User::where('id', myid())->update(['shortcuts' => $request->post('keepenCode')]);
                    if($user)
                    {   
                        $success_msg = 'Your shortcuts updated successfully';
                    }
                    else
                    {   
                        $warrning_msg = 'Operation failed, We are sorry about. Please try again later.';
                    }

                }

               
                

            }
            
            $shortcuts = Shortcuts::All();
            return view('user.mysettings',['subpage' => $subpage, 
                                           'success_msg' => $success_msg,
                                           'warrning_msg' => $warrning_msg,
                                           'shortcuts' => $shortcuts
                                           ]);
        }
        else
        {
            return redirect()->route('home');
        }


    }

    public function myhome(){
        return redirect()->route('myprofile');
    }

    public function check_notifications(Request $request){

        if (Auth::check()){
            header('Content-Type: text/event-stream');
            header('Cache-Control: no-cache');
            ob_start();
            ob_flush();
            $count = Notification::where('seen', '=', 0)->where('user_to', '=', myid())->count();
            
            // Send it in a message
            echo "data: " . $count . "\n\n";
            flush();
        
        }
        else{
            return redirect()->route('index');
        }

    }

    //  sys_info('max_notifixations_dropdown')
    public function load_notifications_json(Request $request){
        
        $notifications = Notification::where('user_to', myid())->orderBy('seen', 'ASC')->orderBy('id', 'DESC')->limit(sys_info('max_notifixations_dropdown'))->get();
        $count_notifications =  Notification::where('user_to', myid())->count();

        return view('user.dropdown_notifications', ['notifications' => $notifications,
                                                    'count_notifications' => $count_notifications
        ]);

    }


    public function page_notifications_json(Request $request){
        
        $max_items = sys_info('max_notifixations_page');
        $notifications = Notification::where('user_to', myid())->orderBy('seen', 'ASC')->orderBy('id', 'DESC')->paginate($max_items);
        $num_has = Notification::where('user_to', myid())->orderBy('seen', 'ASC')->orderBy('id', 'DESC')->get()->count();
         
	    // განსაზღვრავს გვერდის ნომერის (თუ არ არის მითითებული, მაშინ ბუნებრივად 1)
	    $page=(isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	    
        $num_pages = ceil( $num_has / $max_items);
        
	    $start = ( $page * $max_items ) - $max_items;


        $outp = "";
        foreach($notifications as $row) 
        {   
            $seenclass = ($row['seen'] == 0) ? 'notification_unseen' : 'read';
            $url = route('see_notification', [$row['id']]);

            if ($outp != "") {$outp .= ",";}

            $outp .= '{"id":"'.$row["id"].'",';
            $outp .= '"text":"'.$row["text"].'",';
            $outp .= '"url":"'.$url.'",';
            $outp .= '"class":"'.$seenclass. '",';
            $outp .= '"date":"'.humman_date($row["created_at"]).'"}';
        }
        
        $page_minus = (($page - 1) < 1) ? 1 : $page - 1;
	    $page_plus = (($page + 1) > $num_pages) ? $num_pages : $page + 1;
        $pagelist = "";
        for($i = 1; $i <= $num_pages; $i++)
        {			
            if ($pagelist != "") {$pagelist .= ",";}
            
            $addclass = ($i == $page ? 'current_wpage' : 'common_pitem');
            $p_url = route('MyNotifications', ['page' => $i]);

            $pagelist .= '{"p_num":"'.$i.'","pn_class":"'.$addclass.'","url":"'.$p_url.'"}';
        }
        
        
        $outp ='{"notifications":['.$outp.'],"p_n":[{"total_pages":"'.$num_pages.'","prev":"'.$page_minus.'","current_page":"'.$page.'","next":"'.$page_plus.'"}],"pglist":['.$pagelist.']}';
	    return $outp;
   
    }



    public function see_notification(Request $request, $id){
        
        $notifications = Notification::where('id', '=', $id)->where('user_to', '=', myid())->get();
        
        if($id >= 1 && $notifications->count() == 1 && notification_info($id, 'seen') == 0){
          
            $update = Notification::where('id', $id)->update(['seen' => 1]);
            return redirect(notification_info($id, 'link_to'));
        }
        else
        {
            return redirect()->route('index');
        }
        
    }




    public function MyNotifications(Request $request)
    {   
        if($user = Auth::user())
        {
            $num_has = Notification::where('user_to', myid())->orderBy('id', 'ASC')->get()->count();

            if($request->isMethod('post')) 
            {   //if post
                if($request->post('read_all') == "read")
                {   //if post read as seen
                    $notifications = Notification::where([
                        ['user_to', '=', myid()],
                        ['seen', '=', 0]
                        ])->get();
                    
                    foreach($notifications as $notification)
                    {   
                        $doseen = Notification::where('id', $notification->id)->update(['seen' => 1]);
                         
                    }
                }

                if($request->post('clear') == "all")
                {   
                    //if post clear
                    $ck = $num_has;
                    $x=0;
                    $notifications = Notification::where('user_to', myid())->get();
                    foreach($notifications as $notification)
                    {   $x++;
                        Notification::where('id', $notification->id)->delete(); 
                        if($x == $ck){
                            //return $x."---".$ck;
                            return redirect()->route('MyNotifications');
                        }    
                    }
                }
            }

            $page=($request->get('page')) ? (int)$request->get('page') : 1;
            return view('user.notifications_page', ['page' => $page, 'total' => $num_has]);

        }
    }
    




    public function MyMessagesData(Request $request, $thing)
    {
        
        if($request->isMethod('get'))
        {   
            // sys_info('max_notifixations_page')
            if($thing == 'contacts')
            {   if($request->get('max') == 'all')
                {
                    $Query = PMTopic::Where('with_to', myid())->orWhere('starter', myid())->orderBy('updated_at', 'DESC')->get();
                }
                else
                {
                    $Query = PMTopic::Where('with_to', myid())->orWhere('starter', myid())->orderBy('updated_at', 'DESC')->limit(sys_info('max_contacts_dropdown'))->get();
                }
                
                $output = "";
                foreach($Query as $row)
                {   
                    $nt_class = ($row['status']==1) ? 'notification_unseen' : 'notification_seen';
                    
                    if($row['starter'] == myid())
				    {	
					    $seen = ($row['starter_saw'] == 0 ? 'active-pm' : 'non_active-pm'); // returns true
					    $recipient = user_info($row['with_to'], 'name');
					    $avatar = user_info($row['with_to'], 'avatar');
					    $bullet_class = pm_online($row['with_to']);
					    $recipient_id = $row['with_to'];
				    }
				    else
				    {
					    $seen = ($row['with_saw'] == 0 ? 'active-pm' : 'non_active-pm'); // returns true
					    $recipient = user_info($row['starter'], 'name');
					    $avatar = user_info($row['starter'], 'avatar');
					    $bullet_class = pm_online($row['starter']);
					    $recipient_id = $row['starter'];
				    }
             
                    if ($output != "") {$output .= ",";}
                    $conversition_url = route('messages',['messages', $row['id']]);
                    $output .= '{"id":"'.$row['id'].'","url":"'.$conversition_url.'","recipient":"'.$recipient.'","recipient_id":"'.$recipient_id.'","recipient_avatar":"'.$avatar.'","time":"'.$row['created_at'].'","last_time":"'.humman_date($row['updated_at']).'","seen":"'.$seen.'","bullet_class":"'.$bullet_class.'"}';

                }//foreach

                $output ='{"ddcontacts":['.$output.']}';
                return $output; // route('messages_data', ['ddcontacts']);


                   
            }//ddcontacts
            elseif($thing == 'countpms')
            {
                header('Content-Type: text/event-stream');
                header('Cache-Control: no-cache');
                ob_start();
                ob_flush();
                
                $I_started = PMTopic::where('starter', '=', myid())->where('starter_saw', '=', 0)->count();
                $I_was_started = PMTopic::where('with_to', '=', myid())->where('with_saw', '=', 0)->count();                
                $count = $I_started + $I_was_started;	
                
                // Send it in a message
                echo "data: " . $count . "\n\n";
                flush();
            }
            elseif($thing == 'conversition')
            {
                if($request->get('load')>=1)
                {   
                    //dacva schirdeba rom sxvisi chatis monacemebi ar gamovides
                    $num_has = PMPost::where('pmt_id', $request->get('load'))->count();
                    
                    $max_items = sys_info('max_pm_posts');
                    
                    $num_pages = ceil( $num_has / $max_items);
	                
                    // განსაზღვრავს გვერდის ნომერის (თუ არ არის მითითებული, მაშინ ბუნებრივად 1)
	                $page=(isset($_GET['page'])) ? (int)$_GET['page'] : $num_pages;
                    
                    $Query = PMPost::where('pmt_id', $request->get('load'))->orderBy('created_at','desc')->paginate($max_items);
        
			        $i=0;
                    $output = "";

                    /* Stick as seen If I have seen */
                    if(pm_topic($request->get('load'), 'starter') == myid()){
     
                        PMTopic::where('id', $request->get('load'))->update(['starter_saw' => 1]);
                    }
                    else
                    {
                        PMTopic::where('id', $request->get('load'))->update(['with_saw' => 1]);
                    }



			        foreach($Query->sortBy('created_at') as $row)
                    {
				        $i++;
                        $profileURL = route('user_profile',[$row['user_by']]);
				        $avatar = user_info($row['user_by'],'avatar');
                        if ($output != "") {$output .= ",";}
				        $output .= '{"id":"'.$row['id'].'","text":"'.base64_encode(BBcode(smiles($row['text']))).'","avatar":"'.$avatar.'", "profileURL":"'.$profileURL.'", "by":"'.$row['user_by'].'","to":"'.$row['user_to'].'","date":"'.$row['created_at'].'","just_me":"'.myid().'"}';
                        
			        }
                    return '{"posts":['.$output.'],"page_stat":[{"current":"'.$page.'","total_pages":"'.$num_pages.'"}]}';//route('messages_data',['conversition', 'load' => 1]);
                
                }
            }
            elseif($thing == 'cconversition')
            {   
                if($request->get('count') >= 1)
                {   
                    header('Content-Type: text/event-stream');
                    header('Cache-Control: no-cache');
                    ob_start();
                    ob_flush();
                    $count = PMPost::where('pmt_id', $request->get('count'))->where('user_to', myid())->count();             
                    
                    // Send it in a message
                    echo "data: " . $count . "\n\n";
                    flush();
                }
            }
            elseif($thing == 'pmrealtimer')
            {
                if($request->get('count') >= 1 && $request->get('to') >= 1)
                {
                    return view('user.pm_realtimer', ['dialog' => $request->get('count'), 'to' => $request->get('to')]);
                }

            }
        
        }//get
        
    }


    public function SendPM(Request $request){
        $input = $request->all();
                    
                 //START POST NEW PRIVATE MESSAGE
                 if($request->post('pm_post') && $request->post('pm_to') && $request->post('pm_topic')>=0)
                 {  
                    $posted_msg = $request->post('pm_post');
                    $pm_topic = $request->post('pm_topic');
                    $pm_to = $request->post('pm_to');
                    
                    //return response()->json(['success' => 'pm topic Success ---'.$posted_msg.'---topic='.$pm_topic.'--witha='.$pm_to]);

                    if($pm_topic != 0)
                    {   
                        $PMP_insert = PMPost::insert([ 
                                            'text' => $posted_msg, 
                                            'user_by' => myid(),
                                            'user_to' => $pm_to,
                                            'pmt_id' => $pm_topic,
                                            'created_at' => \Carbon\Carbon::now(),
                                            'updated_at' => \Carbon\Carbon::now()
                                        ]);
     
                        if($PMP_insert)
                        {
         
                            if(pm_topic($pm_topic, 'starter') == myid()){
     
                                PMTopic::where('id', $pm_topic)->update(['starter_saw' => 1, 'with_saw' => 0]);
                            }
                            else
                            {
                                PMTopic::where('id', $pm_topic)->update(['starter_saw' => 0, 'with_saw' => 1]);
                            }	
                                 
                            return response()->json(['success' => 'Success']);
                        }
                        else
                        {
                            return response()->json(['success' => 'Fuck']);
                        }
                       
                    }
                    else
                    {	
                        
                        $post_values = ['starter' => myid(),
                                        'with_to' => $pm_to,
                                        'starter_saw' => 1,
                                        'with_saw' => 0,
                                        'created_at' => \Carbon\Carbon::now(),
                                        'updated_at' => \Carbon\Carbon::now()
                                    ];
                        $ins_pmtopic = PMTopic::insertGetId($post_values);
                        
                        if($ins_pmtopic)
                        {	
                            
                            
                            $PMP_insert = PMPost::insertGetId([ 
                                'text' => $posted_msg, 
                                'user_by' => myid(),
                                'user_to' => $pm_to,
                                'pmt_id' => $ins_pmtopic,
                                'created_at' => \Carbon\Carbon::now(),
                                'updated_at' => \Carbon\Carbon::now()
                            ]);
                            //return response()->json(['success' => '222 pm topic -----'.$PMP_insert]);
                            if($PMP_insert)
                            {
                                return response()->json(['success' => $ins_pmtopic]);     
                            }
     
                        }//end if pm_topic insert
                         
         
                    }
     
                 }
        
                 //END POST NEW PRIVATE MESSAGE
        
    }



    public function MyMessages(Request $request, $thing = null, $id = null)
    {

        if($user = Auth::user())
        {   
            $new_id = ($thing == "contact" && $id > 0) ? $id : null;
            $just_id = ($thing == "messages" && $id > 0) ? $id : null;
            
            $page=($request->get('page')) ? (int)$request->get('page') : 1;
            $smiles = PMSmiles::orderBy('id', 'asc')->get();
            $I_started = PMTopic::where('starter', myid())->where('with_to', $request->get('contact'))->get();
         
            if($thing == "contact" && $id >= 1)
            {  
                if($thing == "contact" && $id == myid())
                {
                    return redirect()->route('home');
                }
                
                $I_started = PMTopic::where('starter', myid())->where('with_to', $request->get('contact'))->get();
                $I_was_started = PMTopic::where('with_to', myid())->where('starter', $request->get('contact'))->get();
                
                if($I_started->count() == 1)
                {
                    foreach($I_started as $row)
                    {
                        return redirect()->route('messages', ['messages', $row->id]);
                    }
                }
                elseif($I_was_started->count() == 1)
                {
                    foreach($I_was_started as $row)
                    {
                        return redirect()->route('messages', ['messages', $row->id]);
                    }

                }
                else
                {
                    if($thing == "contact" && user_info($id, 'id') < 1)
                    {
                        return redirect()->route('home');
                    }
                }
                
            }
            elseif($thing == "messages" && $id >= 1)
            {
                if(LoadDialog_withto($id) == 0)
                {
                    return redirect()->route('messages', ['messages']);
                }

            }

            return view('user.messages', ['id' => $id, 'smiles' => $smiles, 'page' => $page, 'var_contact' => $new_id]);
            
            
        }
        else
        {
            return redirect()->route('home');
        }
    }
   

}
