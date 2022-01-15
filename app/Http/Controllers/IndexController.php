<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\topic;
use App\Models\Post;
use App\Models\User;
use App\Models\Categories;
use App\Models\PollQuestion;
use App\Models\PollTaken;
use App\Models\Notification;
use App\Models\Ticket;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class IndexController extends Controller
{   

    public function index(){

        $data = topic::orderBy('created_at', 'desc')->paginate(sys_info('maxt_main'));
        return view('index', ['topics' => $data]);
    }

    public function forum(Request $request, $get_forum_id){
        
        if(cat_info($get_forum_id, 'id') < 1){
    
            return redirect()->route('index');
        }
        else
        {   
            
            $lastpage=getLastPage(cat_info($get_forum_id, 'topics_in'), sys_info('maxt_incat'));
            if($request->get('page') > $lastpage){
    
                return redirect()->route('forum', ['get_forum_id' => $get_forum_id, 'page' => $lastpage]);
            }

            $data = topic::where("cat_id", $get_forum_id)->orderBy('created_at', 'desc')->paginate(sys_info('maxt_incat'));
            $topics_in_cat = topic::where("cat_id", $get_forum_id)->count();

            return view('viewforum.list', ['topics' => $data,
                                           'cat' => $get_forum_id,
                                           'topics_in_cat' => $topics_in_cat
                                          ]);
        }

    }

    public function addtopic(Request $request, $get_forum_id){
        
        if(Auth::guest() || cat_info($get_forum_id, 'id') < 1){
    
            return redirect()->route('index');
            
        }
        else
        { //if user logged in

            if ($request->isMethod('post'))
            { 
                $messages = [
                    'required' => 'ველი :attribute აუცილებლად უნდა შეავსოთ',
                    'title.required' => 'აუცილებლად შეიყვანეთ თემის სახელი',
                    'content.required' => 'პოსტი უნდა შეიცავდეს მინიმუმ 10 სიმბოლოს',
                ];
            

                $this->validate($request, [

                    'title' => 'required|max:100',
                    'cat_id' => 'required',
                    //ჩვენ ვიკენებთ სამმერნოუთს და ცარიელი ველი შეიცავს 11 სიმბოლოს + მომხმარებლის აკრებილი 10 სიმბოლო
                    'content' => 'required|min:21',
                    'question' => 'max:100',
                    'q_one' => 'max:50',
                    'q_two' => 'max:50',
                    'q_three' => 'max:50',
                    'q_four' => 'max:50',
                    'q_five' => 'max:50',
                    'q_six' => 'max:50',
                    'q_seven' => 'max:50',
                    'start_date' => 'max:19',
                    'end_date' => 'max:19',
                    'offstatus' => 'max:1'
                
                ], $messages);

                $data = $request->all();
                
                $values = array('title' => $request->post('title'), 
                                'user_by' => myid(),
                                'cat_id' => $request->post('cat_id'),
                                'close' => 0,
                                'created_at' => \Carbon\Carbon::now(),
                                'updated_at' => \Carbon\Carbon::now());
                $ins_topic = DB::table('topics')->insert($values);


                if($ins_topic)
                {
                    $t_id = DB::getPdo()->lastInsertId();
                
                    if(empty($request->post('attachment')))
                    {
                        $attachment = '';
                    }
                    else{
                        $attachment = $request->post('attachment');
                    }
                    
                    $post_values = array('topic_id' => $t_id,
                                        'answers_to' => $request->post('answerskeeper'),
                                        'text' => $request->post('content'),
                                        'attachments' => $attachment,
                                        'posted_by' => myid(),
                                        'edited_by' => 0,
                                        'created_at' => \Carbon\Carbon::now(),
                                        'updated_at' => \Carbon\Carbon::now());
                    $ins_post = DB::table('posts')->insert($post_values);
                    
                    $users_to = $request->post('array');//answers array
                    
                    if($ins_post)
                    {
                        $ins_poll_question = array('t_id' => $t_id, 
                                        'question' => $request->post('question'),//post question
                                        'ans_1' => $request->post('q_one'),
                                        'ans_2' => $request->post('q_two'),
                                        'ans_3' => $request->post('q_three'),
                                        'ans_4' => $request->post('q_four'),
                                        'ans_5' => $request->post('q_five'),
                                        'ans_6' => $request->post('q_six'),
                                        'ans_7' => $request->post('q_seven'),
                                        'disabled' => $request->post('offstatus'),
                                        'starts' => $request->post('start_date'),
                                        'ends' => $request->post('end_date'),
                                        'created_at' => \Carbon\Carbon::now(),
                                        'updated_at' => \Carbon\Carbon::now());
                        $ins_poll = DB::table('poll_question')->insert($ins_poll_question);
                        
                       //insert answers
                       if($users_to){
            
                            foreach ($users_to as $to) {	
        
                                $noification_values = [ 'user_to' => $to, 
                                                        'text' => 'You have a new reply in topic <b>'.$request->post('title').'</b>',
                                                        'link_to' => route('showtopic', ['id' => $t_id]),
                                                        'seen' => 0,
                                                        'created_at' => \Carbon\Carbon::now(),
                                                        'updated_at' => \Carbon\Carbon::now()];
                                if($to != myid()){
                                    Notification::insert($noification_values);
                                }                        
                                
                                               
                            }
                        }
                        //end insert answers

                        if($ins_poll)
                        {
                            return redirect()->route('showtopic', [$t_id]);
                        }


                    }//End if post insert 

                    
                

                }//End if topic insert

            }// end if it posted
        
        
            return view('viewforum.add', ['cat' => $get_forum_id]);
        } //end if user logged in
        
    }

    public function rules(){

        return view('rules');
    }

    public function About(){

        return view('about');
    }

    public function HelpForm (Request $request){

        $status = null;
        if($request->isMethod('post'))
        {   
            $this->validate($request, [
                'name' => 'required|min:2|max:15',
                'surname' => 'required|min:2|max:15',
                'email' => 'required|email|min:8:max:30',
                'subject' => 'required|min:5|max:120',
                'message' => 'required|min:10|max:500'
            ]);

            // name 	lastname 	email 	text 	status 	created_at 	updated_at 
            $values = [
                'name' => $request->post('name'),
                'lastname' => $request->post('surname'),
                'email' => $request->post('email'),
                'subject' => $request->post('subject'),
                'text' => $request->post('message'),
                'status' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ];
            $query = Ticket::insert($values);
            if($query)
            {
                $status = "succesed";
            }
            else
            {
                $status = "failure";
            }


        }

        return view('contact',['status' => $status]);
    }
 
}



