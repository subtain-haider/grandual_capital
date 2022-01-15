<?php
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\topic;
use App\Models\Categories;
use App\Models\User;
use App\Models\Post;
use App\Models\SysOption;
use App\Models\Notification;
use App\Models\Shortcuts;
use App\Models\Ban;
use App\Models\SessionsDB;
use App\Models\PMTopic;
use App\Models\PMPost;
use App\Models\PMSmiles;
use App\Models\Online;
use App\Models\Announcement;
use App\Models\ADPlace;

function count_mtc($id=null){
    $total_topics_incat = topic::where('cat_id', '=', $id)->count();
    return $total_topics_incat;
}

function count_topics_incatBy($id=null, $by=null){
    $total_topics_incat = topic::where('cat_id', '=', $id)->where('user_by', '=', $by)->count();
    return $total_topics_incat;
}

function count_posts_incatBy($id=null, $by=null){
    
    $topics_incat_by = topic::where('cat_id', '=', $id)->where('user_by', '=', $by)->get();

    $postsintopicby = 0;
    foreach($topics_incat_by as $topic)
    {
        $postsintopicby += Post::where('topic_id', '=', $topic->id)->where('posted_by', '=', $by)->count();
        
    }

    return $postsintopicby;
}

function count_statistics_by($of, $by)
{   
    if($of=='topics'){
        return topic::where('user_by', '=', $by)->count();
    }
    elseif($of=='posts')
    {
        return Post::where('posted_by', '=', $by)->count();
    }
    else
    {
        return 'null';
    }
    
}

function count_statistics($of)
{   
    if($of=='topics'){
        return topic::count();
    }
    elseif($of=='users')
    {
        return User::count();
    }
    elseif($of=='posts')
    {
        return Post::count();
    }
    elseif($of=='categories')
    {
        return Categories::count();
    }
    else
    {
        return 'null';
    }
    
}

function list_categories()
{
    $categories = Categories::All();
    
    if($categories){

         foreach ($categories as $row): ?>
                <a href="<?php echo route('forum', array('get_forum_id'=>$row->id)); ?>"class="cat-tag">
                <div class="catfolder-icon"><?php echo $row->icon; ?></div>
                <div class="tag-title"><?php echo $row->title; ?></div>
                <div class="lxp-counts"><?php echo count_mtc($row->id); ?></div>
            </a>
    <?php endforeach;
    }

}

function categoriesMeta()
{
    $categories = Categories::All();
    $keep = null;
    $i = 0;
    if($categories->count() > 0)
    {
        foreach ($categories as $row)
        {   $i++;
            $keep .= ($i > 1 && $i <= $categories->count()) ? "," : "";
            $keep .= $row->title;
        }
        return $keep;
    }
}

function allmetakeywords()
{
    if(sys_info('meta_keywords') != "" && sys_info('meta_keywords') != null)
    {
        return categoriesMeta().",".sys_info('meta_keywords');
    }
    else
    {
        return categoriesMeta();
    }
}


function xposts(){
    $xposts = topic::orderBy('updated_at', 'desc')->limit(sys_info('max_xposts'))->get();

    foreach ($xposts as $xpost):?>
        <div class="card-body border_bottom lastxpost">
            <a href="<?php echo route('showtopic', ['id' => $xpost->id, 'page' => getTopicLastPage($xpost->id)]); ?>" class="active-post-items">
                <div class="lxp-image"><img src="<?php echo asset(user_info(topic_lastpost($xpost->id, 'posted_by'), 'avatar')); ?>"></div>
                <div style="width:100%"><?php echo $xpost->title; ?></div>
                <div class="lxp-counts"><?php echo topic_info($xpost->id, 'posts_in'); ?></div>
            </a>
        </div>
<?php endforeach;
//get_forum_id
}




function cat_info($id=null, $what)
{
    $cats = Categories::where("id", $id)->limit(1)->get();
    
    if($cats->count()==1){
        
        if($what=='topics_in'){
            $topicsintopic = topic::where("cat_id", $id)->count();
            return $topicsintopic;
        }
        elseif($what == "ad")
        {
            $string_length = strlen(cat_info($id, 'ads')) - substr_count(cat_info($id, 'ads'), ' ');
            if(cat_info($id, 'ad_show') == "on" && $string_length == 0)
            {
                return '<a href="'.route('home').'"><img src="'.asset('assets/images/big_banner.png').'" alt="'.sys_info('site_name').' - ads"></a>';
            }
            elseif(cat_info($id, 'ad_show') == "on" && $string_length > 0)
            {
                return cat_info($id, 'ads');
            }

        }
        else
        {
            foreach($cats as $cat){
                return $cat->$what;
            }
        }
    }    
}

function announcement_info($what)
{
    $countcheck = Announcement::where('id', 1)->get();
    if($countcheck->count() == 1)
    {
        return $countcheck[0][$what];
    }
}

function ad_Info($which, $what)
{
    $countcheck = ADPlace::where('id', $which)->get();
    if($countcheck->count() == 1)
    {
        return $countcheck[0][$what];
    }
}

function ShowAd($which)
{
    $default_sidebar = asset('assets/images/sidebar-banner.png');

    $countcheck = ADPlace::where('id', $which)->get();
    if($countcheck->count() == 1)
    {
        // sidebar ads
        if($which == 2 || $which == 3 || $which == 4 || $which == 5)
        {
            $string_length = strlen($countcheck[0]['code']) - substr_count($countcheck[0]['code'], ' ');
            if($countcheck[0]['ad_show'] == "on" && $string_length == 0)
            {
                return '<a href="'.route('home').'"><img src="'.$default_sidebar.'" alt="'.sys_info('site_name').' - ads"></a>';
            }
            elseif($countcheck[0]['ad_show'] == "on" && $string_length > 0)
            {
                return $countcheck[0]['code'];
            }

        }
        elseif($which == 1 || $which == 8) // main page
        {
            $string_length = strlen($countcheck[0]['code']) - substr_count($countcheck[0]['code'], ' ');
            if($countcheck[0]['ad_show'] == "on" && $string_length == 0)
            {
                return '<a href="'.route('home').'"><img src="'.asset('assets/images/big_banner.png').'" alt="'.sys_info('site_name').' - ads"></a>';
            }
            elseif($countcheck[0]['ad_show'] == "on" && $string_length > 0)
            {
                return $countcheck[0]['code'];
            }

        }
        elseif($which == 6 || $which == 7) // main page
        {
            $string_length = strlen($countcheck[0]['code']) - substr_count($countcheck[0]['code'], ' ');
            if($countcheck[0]['ad_show'] == "on" && $string_length == 0)
            {
                return '<a href="'.route('home').'"><img src="'.asset('assets/images/footer_banner.png').'" alt="'.sys_info('site_name').' - ads"></a>';
            }
            elseif($countcheck[0]['ad_show'] == "on" && $string_length > 0)
            {
                return $countcheck[0]['code'];
            }

        }
        
    }
}




function cat_info_by_topic($id=null, $what)
{
    $topics = topic::where("id", $id)->limit(1)->get();
    
    if($topics->count()==1){
        foreach($topics as $topic){

            return cat_info($topic->cat_id, $what);

        }
    }    
}

function user_info($id=null, $what)
{
    $users = User::where("id", $id)->limit(1)->get();

    if($users->count()==1){
        foreach($users as $user){

            if($what=='avatar'){
                if(!$user->$what){
                    return asset('assets/images/avatar_default.png');
                }
                else{
                    return $user->avatar;
                }
            }else{
                return $user->$what;
            }
            
        }
    }    
}



function level ($id)
{
    //, $levels)
    $user_level = (empty(user_info($id, 'level')) ? 0 : user_info($id, 'level')); // returns true

	$levels = [
    0 => 'Member',
    1 => 'Moderator',
    2 => 'Global Moderator',
    3 => 'Administrator'
    ];
 
  $default = '';
  
  $level = array_key_exists($user_level, $levels) ? $levels[$user_level] : $default;
 
  return $level;
}


function gender($id)
{
    //, $levels)
    $user_gender = (empty(user_info($id, 'gender')) ? 0 : user_info($id, 'gender')); // returns true

	$genders = [
        0 => '',
        1 => 'Female',
        2 => 'Male',
        3 => 'Female'
    ];
 
  $default = '';
  
  $level = array_key_exists($user_gender, $genders) ? $genders[$user_gender] : $default;
 
  return $level;
}




function my($what)
{
    $users = User::where("id", myid())->limit(1)->get();
    
    if($users->count()==1){
        foreach($users as $user){
            if($what == 'level_num')
            {
                return (empty(user_info(myid(), 'level')) ? 0 : user_info(myid(), 'level')); // returns true

            }
            else
            {
                return $user->$what;
            }
        }
    }    
}



function user_premissed_at($user){
    
    $premissions = user_info($user, 'moder_of_forums');

	$fruits_ar = explode(',', $premissions);
	$output = '';
	foreach($fruits_ar as $x => $val) {
        if(!empty($val)){
 		    $output .= '<a href="'.route('forum', array('get_forum_id'=>$val)).'" class="CatsTag"><span>'.cat_info($val, 'title').'</span></a>';
        }
        else
        {
            return '';
        }
    }
    return $output;
    
}


function user_premission_at($user, $forum){

    if(user_info($user, 'level') == 2 || user_info($user, 'level') == 3){
        return $forum;
    }
    elseif(user_info($user, 'level') == 1)
    {
        $premissions = user_info($user, 'moder_of_forums');

	    $fruits_ar = explode(',', $premissions);
	    $output = '';
	    foreach($fruits_ar as $x => $val) {
 		    if($val == cat_info($forum, 'id'))
                $output .= cat_info($val, 'id');
	        }
        return $output;
    }
    else{
        return 0;
    }
    
}



function sys_info($what)
{
    $SysOptions = SysOption::where("id", 1)->limit(1)->get();
    
    if($SysOptions->count()==1){
        foreach($SysOptions as $SysOption){
            return $SysOption->$what;
        }
    }    
}




function notification_info($id, $what)
{
    $Notifications = Notification::where("id", $id)->limit(1)->get();
    
    if($Notifications->count()==1){
        foreach($Notifications as $Notification){
            return $Notification->$what;
        }
    }    
}


function myid()
{
    return Auth::user()->id;
}

function nextXday($x)
{
    // next $x day date
    return date('Y-m-d H:i:s', time() + 60 * 60 * 24 * $x);
}

function DatePlusMin($minutes)
{   $int_minutes = (int)$minutes;
    return date('Y-m-d H:i:s', time() + 60 * $int_minutes);
}


function dayXnow()
{
	// next $x day date
   return \Carbon\Carbon::now();
}

function bytesToHuman($bytes)
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

    for ($i = 0; $bytes > 1024; $i++) {
        $bytes /= 1024;
    }

    return round($bytes, 2) . ' ' . $units[$i];
}


function randomString($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }

    return $str;
}


function getLastPage($total, $max){
	if($total >= 1 && $max >= 1)
    {
    	return ceil($total/$max);
    }
}

function getTopicLastPage($id){
	if($id >= 1 && topic_info($id, 'id') >= 1)
    {
        $total = topic_info($id, 'posts_in');

    	return ceil($total/sys_info('maxp_intopic'));
    }
}

function minutesago($date){
	$b = dayXnow();
	//example: 2021-02-06 10:00:00
	$to_time = strtotime($date);
	$from_time = strtotime($b);
	return round(abs($to_time - $from_time) / 60,2);
}


function procenti($ramdeni, $ris){
    if($ramdeni == 0){
        return 0;
    }
    else{
         return round( $ramdeni / $ris * 100);
    }
}


function humman_date($timestamp)
{
    return date("F jS, Y", strtotime($timestamp)); //September 30th, 2013
}

function dateDay($timestamp)
{
    return date("F jS", strtotime($timestamp)); //September 30th, 2013
}

function string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

function get_shortcuts($id=null){
    
	$output = '';
    $m = "'";
    $str = ($id >= 1) ? user_info($id,'shortcuts') : my('shortcuts');

    if(strlen($str) > 5)
    {
        $yo = (explode(",",$str));

        foreach($yo as $val){
	        $output .= '<li class="list-group-item heveredf2" id="mylink_sn_'.string_between($val, '[sm=', ']').'" toset_num="'.string_between($val, '[sm=', ']').'" toset_url="'.string_between($val, ']', '[/sm]').'" toset_clr="'.shortcut_info(string_between($val, '[sm=', ']'), 'color').'"><i class="'.shortcut_info(string_between($val, '[sm=', ']'), 'icon').'" style="color: #'.shortcut_info(string_between($val, '[sm=', ']'), 'color').';" url="'.string_between($val, ']', '[/sm]').'"></i> '.shortcut_info(string_between($val, '[sm=', ']'), 'title').' <span class="smallbadge pull-right"> <button type="button" class="btn btn-outline-info btn-sm" onclick="addShortcut('.$m.shortcut_info(string_between($val, '[sm=', ']'), 'icon').$m.','.$m.shortcut_info(string_between($val, '[sm=', ']'), 'color').$m.', '.$m.shortcut_info(string_between($val, '[sm=', ']'), 'title').$m.','.$m.string_between($val, '[sm=', ']').$m.');"><i class="fas fa-edit"></i></button> <button type="button" class="btn btn-outline-danger btn-sm" onclick="delSN('.string_between($val, '[sm=', ']').');"><i class="fas fa-times"></i></button></span></li>';
        }
        return $output;
    }
}



function shortcut_info($id, $what)
{
    $cats = Shortcuts::where("id", $id)->limit(1)->get();
    
    if($cats->count()==1){
    
        foreach($cats as $cat){
            return $cat->$what;
        }
        
    }    
}



function get_user_shortcuts($id)
{    
	$output = '';
    $m = "'";
    $str = user_info($id, 'shortcuts');
    
    if(!empty($str))
    {
        $yo = (explode(",",$str));

        foreach($yo as $val){
	        $output .= '<a href="'.string_between($val, ']', '[/sm]').'" class="list-group-item list-group-item-action">
            <i class="'.shortcut_info(string_between($val, '[sm=', ']'), 'icon').'" style="color: #'.shortcut_info(string_between($val, '[sm=', ']'), 'color').';"></i>  '.shortcut_info(string_between($val, '[sm=', ']'), 'title').'
            <span class="smallbadge pull-right"> 
             <button type="button" class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> Visit</button>
            </span>
            </a>'; 
        }
    }
    return $output;   
}


function get_user_mini_shortcuts($id, $num)
{    
	$output = '';
    $m = "'";
    $str = user_info($id, 'shortcuts');
    
    if(!empty($str))
    {
        $yo = (explode(",",$str));
        $i = 0;
        foreach($yo as $val){
            $i++;
	        if($i <= $num){
                
                $output .= '<li class="list-inline-item"><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="'.string_between($val, ']', '[/sm]').'" data-original-title="'.shortcut_info(string_between($val, '[sm=', ']'), 'title').'"><i class="'.shortcut_info(string_between($val, '[sm=', ']'), 'icon').'"></i></a></li>';
            }
        }
    }
    return $output;   
}


function ban_info($id=null, $what)
{
    $bans = Ban::where("user_id", $id)->orderBy('updated_at', 'desc')->limit(1)->get();
    
    if($bans->count()==1){
        foreach($bans as $ban)
        {
            return $ban->$what;
        }
    }    
}

function thisroute()
{
    $Route_name = Route::currentRouteName();
    return $Route_name;
}


function CdddddheckBan($what=null)
{   
    $clientIP = request()->ip();
    $clientUA = request()->server('HTTP_USER_AGENT');
    $sessions = SessionsDB::where('ip_address', $clientIP)->where('user_agent', $clientUA)->orderBy('id', 'desc')->get();

    foreach($sessions as $session)
    {   
        if(ban_info($session['id'], 'banned_till') >= dayXnow())
        {
            return ban_info($session['id'], $what);
        }
        
    }

    

}




function CheckBan($what=null)
{
    $clientIP = request()->ip();
    $clientUA = request()->server('HTTP_USER_AGENT');
    $sessions = SessionsDB::where('ip_address', $clientIP)->where('user_agent', $clientUA)->orderBy('id', 'desc')->get();

    foreach($sessions as $ban)
    {
        $bans = Ban::where([ ['user_id', '=', $ban['user_id']], ['banned_till', '>', dayXnow()] ])->orderBy('updated_at', 'desc')->get();
        

        if($what == 'status')
        {
            return $bans->count();
        }
        else
        {
            if($bans->count() > 0) 
            {   
                foreach($bans as $ban)
                {
                    return "<div class=\"container container-fx\"><div class=\"card-body bg-white\">Warrning, you are punished by <b>".user_info($ban['admin_id'], 'name')."</b> for violating the rules, now you can do nothing except reading the rules!<br/>
                    Reason: <i>".$ban['reason']."</i><br/>
                    Banned till: <i>".$ban['banned_till']."</i>
                    </div></div><br>";
    
                }
                
            }
        }

    }//END FOREACH


}


function DatePlusMinutes($minutes=null)
{
    return date('Y-m-d H:i:s', strtotime("+".$minutes." min"));
}

function pm_online($id=null){
    
    $time=5;
	if(user_info($id, 'last') > time()-$time*60){
		$status_class = 'pm_bullet';
	}
	elseif(user_info($id, 'last') < time()-$time*60){
	    $status_class ='pm_bullet not-online';
	}
    
	return $status_class;
}

function YouAreOnline()
{   
    User::where('id', myid())->update(['last' => time()]);
}


function pm_topic($id=null, $what)
{
    $Query = PMTopic::where("id", $id)->orderBy('id', 'asc')->limit(1)->get();
    
    if($Query->count()==1){
        foreach($Query as $row)
        {
            return $row->$what;
        }
    }    
}

function LoadDialog($id)
{   
    
    if($user = Auth::user() && $id >= 1)
    {
        if(pm_topic($id, 'starter') == myid())
	    {
            return 'load_pm_dialogs('.$id.','.pm_topic($id, 'with_to').');';
	    }
	    elseif(pm_topic($id, 'with_to') == myid())
	    {
            return 'load_pm_dialogs('.$id.','.pm_topic($id, 'starter').');';
	    }

    }
    
}



function LoadDialog_withto($id)
{   

    if($user = Auth::user() && $id >= 1)
    {
        if(pm_topic($id, 'starter') == myid())
	    {
            return pm_topic($id, 'with_to');
	    }
	    elseif(pm_topic($id, 'with_to') == myid())
	    {
            return pm_topic($id, 'starter');
	    }
        else
        {
            return 0;
        }

    }
    
}











function smiles($msg){
	
	$query = PMSmiles::orderBy('id', 'asc')->get();
    foreach($query as $row)
	{
		$code[] = $row['code'];
		$smile_url[] = '<img src="'.asset('/assets/images/smiles/'.$row['path']).'" alt="smile" />';
	}

	$msg = str_replace($code, $smile_url, $msg);
	return $msg;
}




function BBcode($text){
	$zabor="'#";
	$end_zabor="'";
	$rand = rand(111111, 999999);
	$bbcode = array(
		'/\[img\](.+)\[\/img\]/isU'                         =>'<img onclick="IFWVShow(this);" src="$1"/>',
		'/\[media\](.+)\[\/media\]/isU'                     =>'<video controls><source src="$1" type="video/mp4">Your browser does not support the video tag.</video>',
		'/\[youtube\](.+)\[\/youtube\]/isU'                 =>'<div class="embed-responsive embed-responsive-4by3"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/$1"></iframe></div>',
	    '/\[attachment\](.+)\[\/attachment\]/isU'           =>'<div class="uploadedfile"><a href="'.asset('/upload/attachments/').'$1">$1</a></div>',
		'/\[url=(.+)\](.+)\[\/url\]/isU'                  =>'<a href="$1">$2</a>'
    );
 	return preg_replace(array_keys($bbcode),array_values($bbcode),$text);
}




function PMTopicWOS($id, $what)
{
    if($what == 'recipient')
    {
        if(pm_topic($id, 'starter') == myid())
	    {	
		    return pm_topic($id, 'with_to');
	    }
	    else
	    {
		    return pm_topic($id, 'starter');
	    }
    }

}



function rightPMRedirect($id=null)
{
    $iStarted = PMTopic::where('starter', myid())->where('with_to', $id)->get();
    $withStarted = PMTopic::where('with_to', myid())->where('starter', $id)->get();
    
    if($iStarted->count()==1)
    {
        return redirect()->route('messages',[$iStarted[0]['id']]);
    }
    elseif($withStarted->count()==1)
    {
        return redirect()->route('messages',[$withStarted[0]['id']]);
    }
}

function pmlink($uid=0)
{
    if($user = Auth::user())
    {
        $iStarted = PMTopic::where('starter', myid())->where('with_to', $uid)->get();
        $withStarted = PMTopic::where('with_to', myid())->where('starter', $uid)->get();
       
        if($iStarted->count()==1)
        {   
            return route('messages', ['messages', $iStarted[0]['id']]);
        }
        elseif($withStarted->count()==1)
        {   
            return route('messages', ['messages', $withStarted[0]['id']]);
        }
        else
        {
            return route('messages', ['contact', $uid]);
        }
    }
    else
    {
        return route('login');
    }

}


function OnlineUsers($which=null)
{   
    //Get the date five minutes ago before
    $date_before = DatePlusMin(-5);
    
    if($which == "all")
    {
        $allonlineArr = [
            ['updated_at', '>=', DatePlusMin(-4)]
        ];

        $allonline = Online::where($allonlineArr)->get();

        $CalculateFX = ($allonline->count() == 0) ? 1 : $allonline->count();

        return $CalculateFX;
    }
    elseif($which == "guests")
    {   
        // User online status avaiable while five minutes
        $last_ago = (time() - 5 * 60);
        
        // Array "last" value filter for users
        $lastArr = [
            ['last', '>=', $last_ago]
        ];
        
        $guests = User::where($lastArr)->get();
        $minus = OnlineUsers('all') - $guests->count();
        // fix negative numbers
        $CalculateFX = ($minus < 0) ? 0 : $minus;
        
        if($user = Auth::user() && $CalculateFX >= 0)
        {
            return $CalculateFX;
        }
        else
        {   
            return 1;
        }
        

        return $CalculateFX;
    } 
    elseif($which == "logged")
    {   
        // User online status avaiable while five minutes
        $last_ago = (time() - 5 * 60);
        
        // Array "last" value filter for users
        $lastArr = [
            ['last', '>=', $last_ago]
        ];
        
        $logged = User::where($lastArr)->get();

        if($user = Auth::user() && $logged->count() == 0)
        {
            return 0;
        }
        else
        {
            return $logged->count();
        }

    }  
    else
    {
        $mysession_id = Session::getId();
    
        $beforeArr = [
            ['session', '=', $mysession_id],
            ['updated_at', '>=', $date_before]
        ];

        $values = [
            'session' => $mysession_id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ];

        $iam_online = Online::where($beforeArr)->get();
        $iam_Session = Online::where('session', $mysession_id)->get();

        if($iam_Session->count() > 0 && $iam_online->count() > 0)
        {   
            // You are online, do something or nothing
            //return 'me online var '.$iam_online->count();
        }
        elseif($iam_Session->count() > 0 && $iam_online->count() == 0)
        {
            Online::where('session', $mysession_id)->update($values);
            //return 'me online ar var '.$iam_online->count();
        }
        else
        {
            Online::insert($values);
        }

    }
    
}

function LastUser($what=null)
{
    $users = User::orderBy('id','desc')->limit(1)->get();
    
    if($what=="" || $what == null)
    {
        return $users->count();
    }
    
    if($users->count()==1)
    {   
        

        foreach($users as $user)
        {
            return $user->$what; 
        }
    }    
    
}


function viewsHuman($number) {
    $number = (int) preg_replace('/[^0-9]/', '', $number);
    if ($number >= 1000) {
        $rn = round($number);
        $format_number = number_format($rn);
        $ar_nbr = explode(',', $format_number);
        $x_parts = array('K', 'M', 'B', 'T', 'Q');
        $x_count_parts = count($ar_nbr) - 1;
        $dn = $ar_nbr[0] . ((int) $ar_nbr[1][0] !== 0 ? '.' . $ar_nbr[1][0] : '');
        $dn .= $x_parts[$x_count_parts - 1];

        return $dn;
    }
    return $number;
}
