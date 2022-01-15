<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\topic;
use App\Models\Post;
use App\Models\PostReact;
use App\Models\User;
use App\Models\Categories;
use App\Models\PollQuestion;
use App\Models\PollTaken;
use App\Models\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{   

    public function showTopic(Request $request, $id){

        if(topic_info($id, 'id') < 1){
    
            return redirect()->route('index');
        }

        if ($user = Auth::user() && $request->isMethod('post'))
        { 
            $messages = [
                'content.required' => 'The content must be at least 10 characters. ',
                'content.min' => ' The content must be at least 10 characters. '
            ];
            
            $this->validate($request, [

                //ჩვენ ვიკენებთ სამმერნოუთს და ცარიელი ველი შეიცავს 11 სიმბოლოს + მომხმარებლის აკრებილი 10 სიმბოლო
                'content' => 'required|min:21'
                
            ], $messages);

            $post_values = array('topic_id' => $id,
                                'answers_to' => $request->post('answerskeeper'),
                                'text' => $request->post('content'),
                                'attachments' => $request->post('attachment'),
                                'posted_by' => myid(),
                                'edited_by' => 0,
                                'created_at' => \Carbon\Carbon::now(),
                                'updated_at' => \Carbon\Carbon::now());
            $ins_post = Post::insert($post_values);
            

            $users_to = $request->post('array');
            
            if($ins_post)
            {   
                $post_id = DB::getPdo()->lastInsertId();
                $last_page = getLastPage(topic_info($id, 'posts_in'), sys_info('maxp_intopic'));
                
                if($users_to){
                    foreach ($users_to as $to) {	
        
                        $noification_values = [ 'user_to' => $to, 
                                                'text' => 'You have a new reply in topic <b>'.topic_info($id, 'title').'</b>',
                                                'link_to' => route('showtopic', ['id' => $id, 'page' => $last_page]).'#p'.$post_id,
                                                'seen' => 0,
                                                'created_at' => \Carbon\Carbon::now(),
                                                'updated_at' => \Carbon\Carbon::now()];
                        if($to != myid()){
                            Notification::insert($noification_values);
                        } 
                        
                    }
                }
            
                topic::where('id', $id)->update(['updated_at' => \Carbon\Carbon::now()]);

                return redirect()->route('showtopic', ['id' => $id, 'page' => $last_page]);


            }
        }
        
        $lastpage=getLastPage(topic_info($id, 'posts_in'), sys_info('maxp_intopic'));
        if($request->get('page') > $lastpage){
            return redirect()->route('showtopic', ['id' => $id, 'page' => $lastpage]);
        }

        

        $thispage = $request->get('page') ?: 1;
        $posts = Post::where('topic_id', $id)->orderBy('id', 'asc')->paginate(sys_info('maxp_intopic'));
        $first_postid = topic_firstpost($id, 'id');
        $allcats = Categories::All();

        return view('showtopic.topic', ['topicid' => $id, 'posts' => $posts, 'current_page' => $thispage, 'first_postid' => $first_postid, 'all_cats' =>  $allcats]);
    }

    


    
    public function EditPost(Request $request, $postid){
   
        if(Post_info($postid, 'id') < 1){
    
            return redirect()->route('index');
        }

        $cat_id = cat_info_by_topic(Post_info($postid, 'topic_id'), 'id');
        
        if($user = Auth::user() && Post_info($postid, 'id') >= 1 && minutesago(Post_info($postid, 'created_at'))<=5 && Post_info($postid, 'posted_by') == myid() || user_premission_at(myid(), $cat_id) == $cat_id || my('level') >= 2 && my('level') <= 3){
            
            //if user logged in
            if ($request->isMethod('post'))
            { 
                $messages = [
                    'content.required' => 'The content must be at least 10 characters. ',
                    'content.min' => ' The content must be at least 10 characters. '
                ];
                
                $this->validate($request, [
    
                    //ჩვენ ვიკენებთ სამმერნოუთს და ცარიელი ველი შეიცავს 11 სიმბოლოს + მომხმარებლის აკრებილი 10 სიმბოლო
                    'content' => 'required|min:21'
                    
                ], $messages);
                

                $UpdatePost = Post::where('id', $postid)->update([
                    'answers_to' => $request->post('answerskeeper'),
                    'text' => $request->post('content'),
                    'attachments' => $request->post('attachment'),
                    'edited_by' => myid(),
                    'updated_at' => \Carbon\Carbon::now()
                    ]
                 );

                 
                $users_to = $request->post('array');
                $last_page = getLastPage(topic_info(Post_info($postid, 'topic_id'), 'posts_in'), sys_info('maxp_intopic'));
                $gettopic_title = topic_info(Post_info($postid, 'topic_id'), 'title');
                $gettopic_id = Post_info($postid, 'topic_id');


                if($UpdatePost)
                {  
                
                    if($users_to){
                        foreach ($users_to as $to) {	
        
                            $noification_values = [ 'user_to' => $to, 
                                                    'text' => 'You have a new reply in topic <b>'.$gettopic_title.'</b>',
                                                    'link_to' => route('showtopic', ['id' => $gettopic_id, 'page' => $last_page]),
                                                    'seen' => 0,
                                                    'created_at' => \Carbon\Carbon::now(),
                                                    'updated_at' => \Carbon\Carbon::now()];
                            if($to != myid()){
                                Notification::insert($noification_values);
                            } 
                                               
                        }
                    }



                    return redirect()->route('showtopic', ['id' => $gettopic_id, 'page' => $last_page]);
                }

            }
            // end if it posted

            $topicid = Post_info($postid, 'topic_id');
            return view('showtopic.editpost', ['postid' => $postid,
                                                'topicid' => $topicid,
                                                'current_page'=> 1 
                                            ]);
        }
        else{
    
            return redirect()->route('index');
            
        }
    }

    







    public function Edit_Topic(Request $request, $id){
        
        if(topic_info($id, 'id') < 1){
    
            return redirect()->route('index');
        }

        $postid = topic_firstpost($id, 'id');
        $cat_id = topic_info($id, 'cat_id');

        if($user = Auth::user() && topic_info($id, 'id') >= 1 && minutesago(Post_info($postid, 'created_at'))<=5 && Post_info($postid, 'posted_by') == myid() || user_premission_at(myid(), $cat_id) == $cat_id || my('level') >= 2 && my('level') <= 3)
        {   
            
            $poll_id = PollQuestion_By_topicID($id, 'id');


            if ($request->isMethod('post'))
            {
                $messages = [
                    'content.required' => 'The content must be at least 10 characters. ',
                    'content.min' => ' The content must be at least 10 characters. '
                ];
            
                $this->validate($request, [

                    //ჩვენ ვიკენებთ სამმერნოუთს და ცარიელი ველი შეიცავს 11 სიმბოლოს + მომხმარებლის აკრებილი 10 სიმბოლო
                    'content' => 'required|min:21'
                
                ], $messages);


                $topic_values = ['title' => $request->post('title')];
                $ins_topic = topic::where('id', $id)->update($topic_values);

                $UpdatePost = Post::where('id', $postid)->update([
                    'answers_to' => $request->post('answerskeeper'),
                    'text' => $request->post('content'),
                    'attachments' => $request->post('attachment'),
                    'edited_by' => myid()
                    ]
                );


                $ins_poll_question = [
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
                                        'ends' => $request->post('end_date')
                                    ];
                $ins_poll = PollQuestion::where('id', $poll_id)->update($ins_poll_question);


                return redirect()->route('showtopic', [$id]);
            }


            return view('showtopic.editTopic', ['postid' => $postid,
                                                'topicid' => $id,
                                                'cat' => $cat_id,
                                                'pollid' => $poll_id
                                            ]);

        }
        else
        {    
            return redirect()->route('index');
        }

    }


    public function answer_poll(Request $request){
        
        $p_id = $request->post('poll_id');
        $checkQuery = PollQuestion::where('id', $p_id)->get();

        if($checkQuery->count() < 1){
    
            return redirect()->route('index');
        }

        $ans_num = $request->post('answer');
        

        $total_topics_incat = PollTaken::where([
            ['poll_id', '=', $p_id],
            ['u_id', '=', myid()]
        ]);
    
        if($total_topics_incat->count() < 1){
   
            //PollQuestion PollTaken
            $post_answers = [
            'ans_to' => $ans_num,
            'poll_id' => $p_id,
            'u_id' => myid(),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()];
            $ins_answer = PollTaken::insert($post_answers);

            if($ins_answer){
                
                return response()->json([
                    'message'   => 'Thanks, Your answer received'
                ]);
                
            }

        }
        

    }


    public function CloseTopic(Request $request, $id){
   
        if(topic_info($id, 'id') < 1){
    
            return redirect()->route('index');
        }

        $cat_id = cat_info_by_topic($id, 'id');
        $first_postid = topic_firstpost($id, 'id');
        if($user = Auth::user() && Post_info($first_postid, 'id') >= 1 && minutesago(Post_info($first_postid, 'created_at'))<=5 && Post_info($first_postid, 'posted_by') == myid() || user_premission_at(myid(), $cat_id) == $cat_id || my('level') >= 2 && my('level') <= 3){
            
            $close_topic = topic::where('id', $id)->update(['close' => 1, 'closed_by' => my('level_num'), 'closed_by_text' => closed_by_text($id, myid())]);
            if($close_topic){
                return redirect()->route('showtopic', [$id]);
            }
             
        }
        else
        {
            return redirect()->route('index');
        }
    
    }

    public function OpenTopic(Request $request, $id){
   
        if(topic_info($id, 'id') < 1){
    
            return redirect()->route('index');
        }

        $cat_id = cat_info_by_topic($id, 'id');
        $first_postid = topic_firstpost($id, 'id');
        if($user = Auth::user() && Post_info($first_postid, 'id') >= 1 && minutesago(Post_info($first_postid, 'created_at'))<=5 && Post_info($first_postid, 'posted_by') == myid() || user_premission_at(myid(), $cat_id) == $cat_id || my('level') >= 2 && my('level') <= 3){
            
            $close_topic = topic::where('id', $id)->update(['close' => 0, 'closed_by_text' => null]);
            if($close_topic){
                return redirect()->route('showtopic', [$id]);
            }
             
        }
        else
        {
            return redirect()->route('index');
        }
    
    }

    public function DeletePost(Request $request, $id){
   
        if(Post_info($id, 'id') < 1){
    
            return redirect()->route('index');
        }
   
        $cat_id = cat_info_by_topic(Post_info($id, 'topic_id'), 'id');
        $topic_id = Post_info($id, 'topic_id');
        if($user = Auth::user() && Post_info($id, 'id') >= 1 && minutesago(Post_info($id, 'created_at'))<=5 && Post_info($id, 'posted_by') == myid() || user_premission_at(myid(), $cat_id) == $cat_id || my('level') >= 2 && my('level') <= 3){
            
            Post::where('id', $id)->delete();
            return redirect()->route('showtopic', [$topic_id]);
        }
        else
        {
            return redirect()->route('index');
        }
    
    }


    public function MoveTopic(Request $request){
   
        $topic_id = $request->post('topic');
        $category_to = $request->post('category');
    
        if(topic_info($topic_id, 'id') < 1){
    
            return redirect()->route('index');
        }

        $cat_id = cat_info_by_topic($topic_id, 'id');
        $route_link = route('showtopic', [$topic_id]);

        if($user = Auth::user() && user_premission_at(myid(), $cat_id) == $cat_id || my('level') >= 2 && my('level') <= 3){
            
            $move_topic = topic::where('id', $topic_id)->update(['cat_id' => $category_to]);
            if($move_topic){
                
                return response()->json([
                    'message' => 'Just a moment...<br/>The topic moved successfully',
                    'link' => $route_link
                ]);

            }
            else{
                return response()->json([
                    'message' => 'Something went wrong, Sorry!',
                    'link' => 0
                ]);
            }
 
        }

    }



    public function DeleteTopic(Request $request){
   
        $topic_id = $request->post('topic');

        if(topic_info($topic_id, 'id') < 1){
    
            return redirect()->route('index');
        }

        $cat_id = $request->post('category');


        if($user = Auth::user() && user_premission_at(myid(), $cat_id) == $cat_id || my('level') >= 2 && my('level') <= 3)
        {
            $posts = Post::where('topic_id', $topic_id)->orderBy('id', 'asc')->get();
            $sul = $posts->count();
            
            $i = '';
            foreach($posts as $post)
            {   
                $i++;
                
                $delete_posts = Post::where('id', $post->id)->delete();
                if($delete_posts && $i == $sul)
                {
                    //echo $i.'--------------'.$sul.'<br>';
                    
                    if(topic::where('id', $topic_id)->delete())
                    {
                        $data = [
                            'message' => 'Just a moment...<br/>The topic deleted successfully',
                            'link' => route('home')
                        ];
                        header('Content-Type: application/json');
                        echo json_encode($data);

                    }
                    exit;
                }   

            }
           

 
        }
        //function
    }


    public function React(Request $request){
        
        if($user = Auth::user() && $request->isMethod('post'))
        {   
            // post_reactions
            $post = (int)$request->post('post');
            
            if(Post_info($post, 'id') < 1){
    
                return redirect()->route('index');
            }

            $reacted = (int)$request->post('reacted');

            $where = ['reacted_at' => $post, 'reacted_by' => myid()];

            $values = [
                'reacted_at' => $post,
                'reacted_by' => myid(),
                'reaction' => $reacted,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ];

            $query = PostReact::where($where)->get();
            if($query->count()==1)
            {
                PostReact::where($where)->update($values);
            }
            else
            {
                PostReact::insert($values);
            }
            

            return response()->json([
                'message' => 'The operation is successfully',
                'post' => $post,
                'reaction' => $reacted
            ]);
        }
        
    }

  





    


}
