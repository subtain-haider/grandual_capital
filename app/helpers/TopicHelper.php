<?php
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\topic;
use App\Models\Categories;
use App\Models\User;
use App\Models\Post;
use App\Models\SysOption;
use App\Models\Notification;
use App\Models\PollQuestion;
use App\Models\PollTaken;
use App\Models\TopicViews;
use App\Models\PostReact;
use App\Models\Ban;
use App\Models\PMTopic;
use App\Models\PMPost;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


function bitch(){

    return 'bitch';
}


function progressbar_color($n){
    
    $PROGRESBAR_COLOR[1] = "#f44336";
    $PROGRESBAR_COLOR[2] = "#4CAF50";
    $PROGRESBAR_COLOR[3] = "#2196F3";
    $PROGRESBAR_COLOR[4] = "#00bcd4";
    $PROGRESBAR_COLOR[5] = "#ff9800";
    $PROGRESBAR_COLOR[6] = "#1abc9c";
    $PROGRESBAR_COLOR[7] = "#fdba04";

    return $PROGRESBAR_COLOR[$n];

}

function ifanswered($p_id){
   
    if(Auth::guest()){
        return 1;
    }
    else{
        $total_topics_incat = PollTaken::where([
            ['poll_id', '=', $p_id],
            ['u_id', '=', myid()]
        ]);
    
        return $total_topics_incat->count();
    }
}

function poll_reviewers($p_id){
    
    $total_topics_incat = PollTaken::where('poll_id', $p_id);
    
    return $total_topics_incat->count();
}


function total_answer_answered_reviewers($p_id, $answer){

    $total_topics_incat = PollTaken::where([
        ['poll_id', '=', $p_id],
        ['ans_to', '=', $answer]
    ]);
    
    return $total_topics_incat->count();
}

function topic_firstpost($id, $what){
    $posts = Post::where("topic_id", $id)->orderBy('id', 'asc')->limit(1)->get();

    foreach($posts as $post){
       return $post[$what];
    }
}

function PollQuestion($id, $what){
    $posts = PollQuestion::where("id", $id)->orderBy('id', 'asc')->limit(1)->get();

    foreach($posts as $post){
       return $post[$what];
    }
}

function PollQuestion_By_topicID($topic_id, $what){
    $posts = PollQuestion::where("t_id", $topic_id)->orderBy('id', 'asc')->limit(1)->get();
   
    foreach($posts as $post){
       return $post[$what];
    }
}


function ViewTopic($id)
{   
    $id = (int)$id;
    $session_id = Session::getId();
    $values = ['session_id' => $session_id, 'topic_id' => $id];
    $query = TopicViews::where($values)->get();
    
    if($query->count() == 0)
    {
        TopicViews::insert($values);
    }

}


function topic_info($id=null, $what)
{
    $topics = topic::where("id", $id)->limit(1)->get();

    if($what=='posts_in'){
        $postsintopic = Post::where("topic_id", $id)->count();
        return $postsintopic;
    }
    elseif($what=='views')
    {
        $values = ['topic_id' => $id];
        $query = TopicViews::where($values)->get();
        return viewsHuman($query->count());
    }
    else
    {
        if($topics->count()==1){
            foreach($topics as $topic){
                return $topic->$what;
            }
        } 
    }
   
}

function closed_by_text($id, $by){
    $cat_id = cat_info_by_topic($id, 'id');
    $first_author = topic_firstpost($id, 'posted_by');
    
    $closed_by_text = 'This topic is closed by';
    $closed_warrning = 'Now nobody can post new or edit old posts in this topic.';

    if($by == $first_author){
        return $closed_by_text.' Its author. '.$closed_warrning;
    }
    else
    {
        if(user_info($by, 'level') == 1){
            return $closed_by_text.' the moderator of this forum. '.$closed_warrning;
        }
        elseif(user_info($by, 'level') == 2){
            return $closed_by_text.' the global moderator. '.$closed_warrning;
        }
        elseif(user_info($by, 'level') == 3){
            return $closed_by_text.' the Administrator. '.$closed_warrning;
        }
        else{
            return $closed_by_text.'. '.$closed_warrning;
        }

    }
    
    
}

function Post_info($id=null, $what)
{
    $posts = Post::where("id", $id)->limit(1)->get();

    if($posts->count()==1){
        
        foreach($posts as $post){
            return $post->$what;
        }
    }
   
}




function topic_lastpost($id=null, $what)
{
    $posts = Post::where('topic_id', $id)->orderBy('id', 'desc')->limit(1)->get();
    
    if($posts->count()==1){
        foreach($posts as $post){
            return $post->$what;
        }
    }    
}

function PostReacted($id, $what){
    $query = PostReact::where('reacted_at', $id)->get();
    $default = '<i class="las la-thumbs-up"></i><span class="post-actionss_name">Like</span>';
    if($query->count()>=1)
    {
        if($what == "icon")
        {
            $like = '<div class="reacted likebutton"><i class="las la-thumbs-up"></i></div>';
            $haha = '<div class="reacted haha"><i class="las la-grin-squint-tears"></i></div>';
            $beer = '<div class="reacted beer"><i class="las la-beer"></i></div>';
            $diss = '<div class="reacted dislikebutton"><i class="las la-thumbs-down"></i></div>';
            
            if($query[0]['reaction'] == 1)
            {
                return $like;
            }
            elseif($query[0]['reaction'] == 2)
            {
                return $haha;
            }
            elseif($query[0]['reaction'] == 3)
            {
                return $beer;
            }
            elseif($query[0]['reaction'] == 4)
            {
                return $diss;
            }
            else
            {
                return $default;
            }
        }
        else
        {
            return $query[0][$what];
        }
        
    }
    else
    {
        if($what == "icon")
        {
            return $default;
        }
    }
    
}


function posts_incategory($id)
{
    $result = Post::whereIn('topic_id',function ($query) use ($id) {
        $query->select('id')->from('topics')->Where('cat_id', $id);
    })->get();

    return $result->count();
   
}

function Trush_posts(){

    $result = Post::whereNotIn('topic_id',function ($query){
        $query->select('id')->from('topics');
    })->get();

    return $result->count();
}

function Trush_topics(){

    $result = topic::whereNotIn('cat_id',function ($query){
        $query->select('id')->from('categories');
    })->get();

    return $result->count();
}

function Trush_polls(){

    $result = PollQuestion::whereNotIn('t_id',function ($query){
        $query->select('id')->from('topics');
    })->get();

    return $result->count();
}

function Trush_post_reactions(){

    $result = PostReact::whereNotIn('reacted_at',function ($query){
        $query->select('id')->from('posts');
    })->get();
    
    return $result->count();
}


function Trush_topic_views(){
    
    $result = TopicViews::whereNotIn('topic_id',function ($query){
        $query->select('id')->from('topics');
    })->get();
    
    return $result->count();
}

function Trush_banned_list(){

    $result = Ban::whereNotIn('user_id',function ($query){
        $query->select('id')->from('users');
    })->get();
    
    return $result->count();
}

function Trush_notifications(){

    $result = Notification::whereNotIn('user_to',function ($query){
        $query->select('id')->from('users');
    })->get();
    
    return $result->count();
}

function Trush_pm_topic(){

    $result = PMTopic::whereNotIn('starter',function ($query){
        $query->select('id')->from('users');
    })->whereNotIn('with_to',function ($query){
        $query->select('id')->from('users');
    })->get();
    
    return $result->count();
}

function Trush_pm_post(){
    
    $result = PMPost::whereNotIn('pmt_id',function ($query){
        $query->select('id')->from('pm_topic');
    })->get();
    
    return $result->count();
}


function Trush_poll_taken(){

    $result = PollTaken::whereNotIn('poll_id',function ($query){
        $query->select('id')->from('poll_question');
    })->get();
    
    return $result->count();
}



//function getRandomColor() {
//    $letters = [0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F'];
//    $color = '#';
//    for ($i = 0; $i < 6; $i++) {
//    $color .= $letters[floor(rand(0,15))];
//    }
//    return $color;
//}

function colorsArrayValues($n)
{
    $color = " '#15ca20', 'dodgerblue', '#fd3550', '#ffc300', '#ff6358', '#28b4c8', '#2d73f5', '#900c3f', ";
    if($n > 8)
    {   $randSul = ( $n - 8 );
        //return $randSul;
        for ($i = 0; $i < $randSul; $i++) 
        {
            $color .= "'".getRandomColor()."'";
            
            if(($n-8) != ($i+1))
            {
                $color .= ",";
            }
        }

    }
    return $color;
}
?>