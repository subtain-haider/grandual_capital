<?php
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\ADPlace;
use App\Models\Ban;
use App\Models\BanTimes;
use App\Models\Categories;
use App\Models\Notification;
use App\Models\Online;
use App\Models\PMPost;
use App\Models\PMSmiles;
use App\Models\PMTopic;
use App\Models\PollQuestion;
use App\Models\PollTaken;
use App\Models\Post;
use App\Models\PostReact;
use App\Models\SessionsDB;
use App\Models\Shortcuts;
use App\Models\SysOption;
use App\Models\topic;
use App\Models\TopicViews;
use App\Models\User;
use App\Models\Ticket;

function adcats()
{
    $query = ADPlace::orderBy('id')->get();
    return $query;
}


function OnlineStat($date_to)
{   
    $date = date_create($date_to);
	$from = date_format($date,"Y-m-d 00:01:00");
    $to = date_format($date,"Y-m-d 23:59:59");

    //$from = date('2021-04-27 00:41:48');
    //$to = date('2021-05-27 00:41:48');

    $query = Online::whereBetween('created_at', [$from, $to])->get();
    return $query->count();  
}

function TopicsStat($date_to)
{   
    $date = date_create($date_to);
	$from = date_format($date,"Y-m-d 00:01:00");
    $to = date_format($date,"Y-m-d 23:59:59");

    $query = topic::whereBetween('created_at', [$from, $to])->get();
    return $query->count();  
}

function PostStat($date_to)
{   
    $date = date_create($date_to);
	$from = date_format($date,"Y-m-d 00:01:00");
    $to = date_format($date,"Y-m-d 23:59:59");

    $query = Post::whereBetween('created_at', [$from, $to])->get();
    return $query->count();  
}

function CategoryStat($what=null)
{   

    $query = Categories::orderBy('id','asc')->get();
    $labels = "";
    $data = "";
    foreach($query as $cat)
    {   
        //chart labels
        $labels .= '"'.$cat['title'].'",';

        //chart data
        $data .= '"'.count_mtc($cat['id']).'",';
    }

    if($what == "labels")
    {
        return $labels;
    }
    elseif($what == "data")
    {
        return $data;
    }
    else
    {

    } 
}



function ticket_staus($id, $what)
{
    $query = Ticket::where('id', $id)->limit(1)->get();
    if($query->count() == 1)
    {
        if($what == 'write')
        {
            $write = [
                1 => 'Unread',
                2 => 'Revieving',
                3 => 'Completed'
            ];

            $default = '';
            return array_key_exists($query[0]['status'], $write) ? $write[$query[0]['status']] : $default;
        }
        elseif($what == 'class')
        {
            $class = [
                1 => 'bg-primary',
                2 => 'bg-warning',
                3 => 'bg-success'
            ];

            $default = '';
            return array_key_exists($query[0]['status'], $class) ? $class[$query[0]['status']] : $default;
        }

    }

}

function ticket_info($id, $what)
{
    $query = Ticket::where('id', $id)->limit(1)->get();
    if($query->count() == 1)
    {
        return $query[0][$what];
    }
}
?>