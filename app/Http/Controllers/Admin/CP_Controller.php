<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

// Models
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
use App\Models\Announcement;
use App\Models\Ticket;
use App\Models\TicketAnswer;
use App\Models\Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Mail;


class CP_Controller extends Controller
{
    //
    public function index(Request $request)
    {  
        if($user = Auth::user() && my('level') == 3)
        { 
            $data = topic::orderBy('created_at', 'desc')->limit(sys_info('max_lasttpoicsCpDashboard'))->get();
            return view('admin.index', ['lastTopics' => $data]);
        }
        else
        {
            return redirect()->route('home');
        }
    }

    public function AboutUs (Request $request)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            $error_message = null;

            if($request->isMethod('post'))
            {    
                $fullaboutus = $request->post('full_aboutus');// full_aboutus
                $aboutusblock = $request->post('aboutusblock');// about_us_block

                $query = SysOption::where('id', 1)->update(
                    [
                        'full_aboutus' => $fullaboutus,
                        'about_us_block' => $aboutusblock
                    ]
                );

                if($query)
                {
                    return redirect()->route('admin.aboutus');
                }
                else
                {
                    $error_message = 'Oops, Something went wrong, please try again later...';
                }

            }
            return view('admin.about_us', ['err_msg' => $error_message]);
        
        }
        else
        {
            return redirect()->route('home');
        }
    
    }
    // End about us


    // Start therms
    public function Therms (Request $request)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            $error_message = null;

            if($request->isMethod('post'))
            {    
                $therms = $request->post('therms_text');// rules

                $query = SysOption::where('id', 1)->update(['rules' => $therms]);

                if($query)
                {
                    return redirect()->route('admin.therms');
                }
                else
                {
                    $error_message = 'Oops, Something went wrong, please try again later...';
                }

            }
            return view('admin.therms', ['err_msg' => $error_message]);
        
        }
        else
        {
            return redirect()->route('home');
        }
    
    }



    // Start therms
    public function Categories (Request $request)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            $query = Categories::orderBy('id','asc')->paginate(14);
            return view('admin.category.list',['data' => $query]);        
        }
        else
        {
            return redirect()->route('home');
        }
    
    }




    // Start add new category
    public function CategoryAdd (Request $request)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            $error_message = null;
 
            if($request->isMethod('post'))
            {   
                $this->validate($request, [
                    'title' => 'required|min:3'
                ]);

                $arrayValues = [
                    'title' => $request->post('title'),
                    'description' => $request->post('description'),
                    'description_show' => $request->post('description_show'),
                    'icon' => $request->post('icon'),
                    'ads' => $request->post('ad_code'),
                    'ad_show' => $request->post('ad_show')?:"off"
                ];
                
                $query = Categories::insert($arrayValues);
 
                if($query)
                {
                    return redirect()->route('admin.categories');
                }
                else
                {
                    $error_message = 'Oops, Something went wrong, please try again later...';
                }
 
            }
            return view('admin.category.add', ['err_msg' => $error_message]);
         
        }
        else
        {
            return redirect()->route('home');
        }
     
    }


    // Start edit category
    public function CategoryEdit (Request $request, $id=null)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            if(cat_info($id, 'id') < 1)
            {
                return redirect()->route('dashboard');
            }

            $error_message = null;
 
            if($request->isMethod('post'))
            {   
                $this->validate($request, [
                    'title' => 'required|min:3'
                ]);

                $arrayValues = [
                    'title' => $request->post('title'),
                    'description' => $request->post('description'),
                    'description_show' => $request->post('description_show'),
                    'icon' => $request->post('icon'),
                    'ads' => $request->post('ad_code'),
                    'ad_show' => $request->post('ad_show')?:"off"
                ];
                
                $id = (int)$id;
                $query = Categories::where('id', $id)->update($arrayValues);
 
                if($query)
                {
                    return redirect()->route('admin.categories');
                }
                else
                {
                    $error_message = 'Oops, Something went wrong, please try again later...';
                }
 
            }
            return view('admin.category.edit', ['id' => (int)$id, 'err_msg' => $error_message]);
         
        }
        else
        {
            return redirect()->route('home');
        }
     
    }



    // Start therms
    public function CategoryDelete (Request $request, $id=null)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            if(cat_info($id, 'id') < 1)
            {
                return redirect()->route('dashboard');
            }

            $error_message = null;
 
            if($request->isMethod('post'))
            {  
                
                $this->validate($request, [
                    'action-mode' => 'required',
                    'categories' => 'required',
                    'agree' => 'required'
                ]);
                
                $category_to = (int)$request->post('categories');
                
                if($request->post('action-mode') == 'save')
                {
                    $move = topic::where('cat_id', $id)->update(['cat_id' => $category_to]);
                    if($move)
                    {
                        $delete_category = Categories::where('id', $id)->delete();
                        if($delete_category)
                        {
                            return redirect()->route('admin.categories');
                        }
                    }
                }
                else
                {
                    // delete everything connected to this category
                    $deleteTopics = topic::where('cat_id', $id)->delete();
                    if($deleteTopics)
                    {
                        $delete_category = Categories::where('id', $id)->delete();
                        if($delete_category)
                        {
                            return redirect()->route('admin.categories');
                        }
                    }
                }
            }

            $queryCategories = Categories::where('id', '!=' , $id)->get();
            return view('admin.category.delete', ['id' => (int)$id, 'err_msg' => $error_message, 'qcats' => $queryCategories]);
         
        }
        else
        {
            return redirect()->route('home');
        }
        
     
    }



    // Start Announcement
    public function AnnouncementEdit  (Request $request)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            $error_message = null;
 
            if($request->isMethod('post'))
            {   
                $this->validate($request, [
                    'title' => 'required|min:3',
                    'text' => 'required|min:10'
                ]);

                // title 	text 	show_status 	created_at 	updated_at 	
                $countcheck = Announcement::where('id', 1)->get();

                $arrayValues = [
                    'title' => $request->post('title'),
                    'text' => $request->post('text'),
                    'show_status' => $request->post('show_status')?:"off",
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ];
                
                if($countcheck->count() == 0)
                {
                    $query = Announcement::insert($arrayValues);
                }
                else
                {
                    $updateValues = [
                        'title' => $request->post('title'),
                        'text' => $request->post('text'),
                        'show_status' => $request->post('show_status')?:"off"
                    ];

                    $query = Announcement::where('id', 1)->update($updateValues);
                }
                
 
                if($query)
                {
                    return redirect()->route('admin.announcement.edit');
                }
                else
                {
                    $error_message = 'Oops, Something went wrong, please try again later...';
                }
 
            }
            return view('admin.announcement', ['err_msg' => $error_message]);
         
        }
        else
        {
            return redirect()->route('home');
        }
     
    }



    // Start ads footer
    public function AdsFooter  (Request $request)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            $error_message = null;
 
            if($request->isMethod('post'))
            {   
                $this->validate($request, [
                    'ad6_title' => 'required|min:3',
                    'ad7_title' => 'required|min:3'
                ]);

                // ad6_title ad6_code ad6_show
                $countcheckSix = ADPlace::where('id', 6)->get();
                $countcheckSeven = ADPlace::where('id', 7)->get();

                if($countcheckSix->count() == 1 && $countcheckSeven->count() == 1)
                {
                    $arrayValuesSix = [
                        'title' => $request->post('ad6_title'),
                        'code' => $request->post('ad6_code'),
                        'ad_show' => $request->post('ad6_show')?:"off"
                    ];
                
                    $arrayValuesSeven = [
                        'title' => $request->post('ad7_title'),
                        'code' => $request->post('ad7_code'),
                        'ad_show' => $request->post('ad7_show')?:"off"
                    ];
                

                    $query6 = ADPlace::where('id', 6)->update($arrayValuesSix);
                    $query7 = ADPlace::where('id', 7)->update($arrayValuesSeven);
 
                    if($query6 && $query7)
                    {
                        return redirect()->route('admin.ads.footer');
                    }
                    else
                    {
                        $error_message = 'Oops, Something went wrong, please try again later...';
                    }

                }
                else
                {
                    $error_message = 'Oops, that database records not found, if you are the website owner restore databse table from the sql file from the script archive file which you purchased...';
                }
 
            }
            return view('admin.ads.footer', ['err_msg' => $error_message]);
         
        }
        else
        {
            return redirect()->route('home');
        }
     
    }





    // Start ads sidebar
    public function AdsSidebar (Request $request)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            $error_message = null;
 
            if($request->isMethod('post'))
            {   
                $this->validate($request, [
                    'ad2_title' => 'required|min:3',
                    'ad3_title' => 'required|min:3',
                    'ad4_title' => 'required|min:3',
                    'ad5_title' => 'required|min:3'
                ]);

                // Count to check if the records are there
                $countcheckTwo = ADPlace::where('id', 2)->get();
                $countcheckThree = ADPlace::where('id', 3)->get();
                $countcheckFour = ADPlace::where('id', 4)->get();
                $countcheckFive = ADPlace::where('id', 5)->get();

            
                if($countcheckTwo->count() == 1 && $countcheckThree->count() == 1 && $countcheckFour->count() == 1 && $countcheckFive->count() == 1)
                {
                    // 2 - ad2_title             ad2_code            ad2_show
                    $arrayValuesTwo = [
                        'title' => $request->post('ad2_title'),
                        'code' => $request->post('ad2_code'),
                        'ad_show' => $request->post('ad2_show')?:"off"
                    ];
                    
                    // 3 - ad3_title             ad3_code         ad3_show
                    $arrayValuesThree = [
                        'title' => $request->post('ad3_title'),
                        'code' => $request->post('ad3_code'),
                        'ad_show' => $request->post('ad3_show')?:"off"
                    ];

                    // 4 - ad4_title            ad4_code         ad4_show
                    $arrayValuesFour = [
                        'title' => $request->post('ad4_title'),
                        'code' => $request->post('ad4_code'),
                        'ad_show' => $request->post('ad4_show')?:"off"
                    ];

                    // 5 - ad5_title           ad5_code            ad5_show
                    $arrayValuesFive = [
                        'title' => $request->post('ad5_title'),
                        'code' => $request->post('ad5_code'),
                        'ad_show' => $request->post('ad5_show')?:"off"
                    ];

                    $query2 = ADPlace::where('id', 2)->update($arrayValuesTwo);
                    $query3 = ADPlace::where('id', 3)->update($arrayValuesThree);
                    $query4 = ADPlace::where('id', 4)->update($arrayValuesFour);
                    $query5 = ADPlace::where('id', 5)->update($arrayValuesFive);
 
                    if($query2 && $query3 && $query4 && $query5)
                    {
                        return redirect()->route('admin.ads.sidebar');
                    }
                    else
                    {
                        $error_message = 'Oops, Something went wrong, please try again later...';
                    }

                }
                else
                {
                    $error_message = 'Oops, that database records not found, if you are the website owner restore databse table from the sql file from the script archive file which you purchased...';
                }
 
            }
            return view('admin.ads.sidebar', ['err_msg' => $error_message]);
         
        }
        else
        {
            return redirect()->route('home');
        }
     
    }




// Start ads footer
    public function AdsMain  (Request $request)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            $error_message = null;
 
            if($request->isMethod('post'))
            {   
                $this->validate($request, [
                    'ad1_title' => 'required|min:3',
                    'ad8_title' => 'required|min:3',
                ]);

                $countcheckFirst = ADPlace::where('id', 1)->get();
                $countcheckEight = ADPlace::where('id', 8)->get();

                if($countcheckFirst->count() == 1 && $countcheckEight->count() == 1)
                {
                    $arrayValuesFirst = [
                        'title' => $request->post('ad1_title'),
                        'code' => $request->post('ad1_code'),
                        'ad_show' => $request->post('ad1_show')?:"off"
                    ];
                
                    $arrayValuesEight = [
                        'title' => $request->post('ad8_title'),
                        'code' => $request->post('ad8_code'),
                        'ad_show' => $request->post('ad8_show')?:"off"
                    ];
                

                    $query1 = ADPlace::where('id', 1)->update($arrayValuesFirst);
                    $query8 = ADPlace::where('id', 8)->update($arrayValuesEight);
 
                    if($query1 && $query8)
                    {
                        return redirect()->route('admin.ads.main');
                    }
                    else
                    {
                        $error_message = 'Oops, Something went wrong, please try again later...';
                    }

                }
                else
                {
                    $error_message = 'Oops, that database records not found, if you are the website owner restore databse table from the sql file from the script archive file which you purchased...';
                }
 
            }
            return view('admin.ads.main', ['err_msg' => $error_message]);
         
        }
        else
        {
            return redirect()->route('home');
        }
     
    }
    
    public function SupportMain(Request $request)
    {  
        if($user = Auth::user() && my('level') == 3)
        { 
            $count = Ticket::orderBy('id', 'desc')->get()->count();
            $query = Ticket::orderBy('status', 'asc')->orderBy('created_at', 'desc')->paginate(sys_info('supporrttickets_perpage'));
            return view('admin.support.index',['count' => $count, 'data' => $query]);
        }
        else
        {
            return redirect()->route('home');
        }
    }

    public function SupportUnreads(Request $request)
    {  
        if($user = Auth::user() && my('level') == 3)
        { 
            $count = Ticket::where('status', 1)->orderBy('id', 'desc')->get()->count();
            $query = Ticket::where('status', 1)->orderBy('status', 'asc')->orderBy('created_at', 'desc')->paginate(sys_info('supporrttickets_perpage'));
            return view('admin.support.index',['count' => $count, 'data' => $query]);
        }
        else
        {
            return redirect()->route('home');
        }
    }

    public function SupportUnderReviewing(Request $request)
    {  
        if($user = Auth::user() && my('level') == 3)
        {
            $count = Ticket::where('status', 2)->orderBy('id', 'desc')->get()->count();
            $query = Ticket::where('status', 2)->orderBy('status', 'asc')->orderBy('created_at', 'desc')->paginate(sys_info('supporrttickets_perpage'));
            return view('admin.support.index',['count' => $count, 'data' => $query]);
        }
        else
        {
            return redirect()->route('home');
        }
    }

    public function SupportCompleted(Request $request)
    {  
        if($user = Auth::user() && my('level') == 3)
        {
            $count = Ticket::where('status', 3)->orderBy('id', 'desc')->get()->count();
            $query = Ticket::where('status', 3)->orderBy('status', 'asc')->orderBy('created_at', 'desc')->paginate(sys_info('supporrttickets_perpage'));
            return view('admin.support.index',['count' => $count, 'data' => $query]);
        }
        else
        {
            return redirect()->route('home');
        }
        
    }

    public function SupportViewReport(Request $request, $id=null)
    {  
        if($user = Auth::user() && my('level') == 3)
        {
            if(ticket_info($id, 'id') < 1)
            {
                return redirect()->route('dashboard');
            }
            
            if($request->isMethod('post'))
            {   
                $this->validate($request, [
                    'answer' => 'required|min:5'
                ]);

                $values = [
                    'ticket_id' => $id,
                    'text' => $request->post('answer'),
                    'admin_id' => myid(),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ];

                $insertRecord = TicketAnswer::where('ticket_id', $id)->insert($values);
                if($insertRecord)
                {
                    $to_name = ticket_info($id, 'name').' '.ticket_info($id, 'lastname');
                    $to_email = ticket_info($id, 'email');

                    $data = [
                        'name' => $to_name, 
                        'email' => $to_email, 
                        'answer' => $request->post('answer'),
                        'appname' => sys_info('site_name')
                    ];

                    Mail::send('email.report', $data, function($message) use ($to_email, $to_name)
                    {   
                        $message->to($to_email, $to_name)->subject('Answer from support');
                    });

                    return redirect()->route('admin.support.viewreport', [$id]);
                }

            }
            // TicketAnswer
            // ticket_id 	text 	admin_id 	created_at 	updated_at 	
            // SET STAUS "UNDER REVIEW"
            if(ticket_info($id, 'status') != 3)
            {
                Ticket::where('id', $id)->update(['status' => 2]);
            }

            $count = TicketAnswer::where('ticket_id', $id)->orderBy('id', 'asc')->get()->count();
            $query = TicketAnswer::where('ticket_id', $id)->orderBy('id', 'asc')->limit(sys_info('supporrttickets_perpage'))->get();
            return view('admin.support.view_report',['id' => $id, 'count' => $count, 'query' => $query]);
        }
        else
        {
            return redirect()->route('home');
        }

    }

    public function ReportCompleteSelected(Request $request)
    {  
        if($user = Auth::user() && my('level') == 3)
        {
            if($request->isMethod('post'))
            {   
                $this->validate($request, [
                    'selected_ids' => 'required|min:1'
                ]);

                $str = rtrim($request->post('selected_ids'),","); 
                $idArray = explode(",", $str);

                foreach ($idArray as $ides) {
                    Ticket::where('id', $ides)->update(['status' => 3]);
                }
                return redirect()->route('admin.support.completed');
            }
        }
        else
        {
            return redirect()->route('home');
        }

    }

    public function ReportDeleteSelected(Request $request)
    {  
        if($user = Auth::user() && my('level') == 3)
        {
            if($request->isMethod('post'))
            {   
                $this->validate($request, [
                    'delete_ids' => 'required|min:1'
                ]);

                $str = rtrim($request->post('delete_ids'),","); 
                $idArray = explode(",", $str);

                foreach ($idArray as $ides) {
                    
                    TicketAnswer::where('ticket_id', $ides)->delete();
                    Ticket::where('id', $ides)->delete();
                }
                return redirect()->route('admin.support.completed');
            }
        }
        else
        {
            return redirect()->route('home');
        }

    }

    


    public function SupportViewReportDelete(Request $request, $id)
    {  
        if($user = Auth::user() && my('level') == 3)
        {
            if(ticket_info($id, 'id') < 1)
            {
                return redirect()->route('dashboard');
            }
            
            if($request->isMethod('get'))
            {   
                $queryAnswers = TicketAnswer::where('ticket_id', $id)->delete();
                if($queryAnswers)
                {
                    Ticket::where('id', $id)->delete();
                    return redirect()->route('admin.support');
                }
                
            }
        }
        else
        {
            return redirect()->route('home');
        }

    }


    public function SupportViewReportComplete(Request $request, $id)
    {  
        if($user = Auth::user() && my('level') == 3)
        {
            if(ticket_info($id, 'id') < 1)
            {
                return redirect()->route('dashboard');
            }

            if($request->isMethod('get'))
            {   
                $query = Ticket::where('id', $id)->update(['status' => 3]);
                if($query)
                {
                    return redirect()->route('admin.support');
                } 
            }
        }
        else
        {
            return redirect()->route('home');
        }

    }

    
    public function StorageClass(Request $request)
    {  
        if($user = Auth::user() && my('level') == 3)
        {
            $queryCount = Storage::get()->count();
            $query = Storage::orderBy('id', 'desc')->paginate(11);
            return view('admin.storage.index',['count' => $queryCount, 'data' => $query]);
        }
        else
        {
            return redirect()->route('home');
        }

    }






    function Upload_action(Request $request)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            $validation = Validator::make($request->all(), [
                'file' => 'required|mimes:jpeg,png,jpg,gif,zip,txt,pdf|max:3048'
            ]);

            if($validation->passes())
            {
               $image = $request->file('file');
               $rand_num = randomString(30);
               $new_name = $rand_num . '.' . $image->getClientOriginalExtension();
               $original_filename = $request->file('file')->getClientOriginalName();
               
               $filesize = bytesToHuman($request->file('file')->getSize());
               $newfile = "'".$rand_num."','".$image->getClientOriginalExtension()."'";

               $real_location = asset('upload/attachments').'/'.$new_name;
               $image->move(public_path('upload/attachments'), $new_name);
               

               $file_name = urlencode(pathinfo($original_filename, PATHINFO_FILENAME));
               $file_url = route('download_file', [$file_name,$new_name]);
                // 	id 	filename 	file_url 	user_by 	created_at 	updated_at 	
                $values = [
                    'filename' => $original_filename,
                    'file_url' => $file_url,
                    'real_url' => $real_location,
                    'size' => $filesize,
                    'user_by' => myid(),
                    'created_at' => dayXnow(),
                    'updated_at' => dayXnow()
                ];
                $gotID = Storage::insertGetId($values);

                return response()->json([
                   'message'   => 'The file Upload Successfully',
                   'file_url' => $file_url,
                   'real_url' => $real_location,
                   'filename' => $original_filename,
                   'file_size' => $filesize,
                   'deletelink' => route('admin.storage.deletefile',[$gotID]),
                   'by_name' => my('name'),
                   'by_id' => myid(),
                   'class_name'  => 'alert-success',
                   'date' => humman_date(dayXnow())
                ]);
                   
            }
            else
            {
                return response()->json([
                    'message' => $validation->errors()->all(),
                    'file_url' => '',
                    'filename' => '',
                    'file_size' => '',
                    'deletelink' => '',
                    'by_name' => '',
                    'by_id' => '',
                    'class_name'  => 'alert-danger',
                    'date' => humman_date(dayXnow())
                ]);
            }
        }
        else
        {
            return redirect()->route('home');
        }

    }


    
    public function StorageDeleteFile(Request $request, $id)
    {  
        if($user = Auth::user() && my('level') == 3)
        { 
            $queryCount = Storage::where('id', $id)->get()->count();
            
            if($queryCount < 1)
            {
                return redirect()->route('dashboard');
            }

            $query = Storage::where('id', $id)->get();

            $path = public_path()."/".str_replace(asset('/'), "", $query[0]['real_url']);
            if(unlink($path))
            {
                Storage::where('id', $id)->delete();
                return redirect()->route('admin.storage');
            }
        }
        else
        {
            return redirect()->route('home');
        }

    }

    public function Optimisation(Request $request)
    {  
        if($user = Auth::user() && my('level') == 3)
        { 
            return view('admin.optimisation');
        }
        else
        {
            return redirect()->route('home');
        }
    }



    
    // start cleaning action
    public function Trash_Clear(Request $request)
    {  
        if($user = Auth::user() && my('level') == 3)
        { 
            $input = $request->all();

            if($request->post('action') == "clear_posts")
            {

                $query = Post::whereNotIn('topic_id',function ($SubQuery){
                    $SubQuery->select('id')->from('topics');
                })->get();

                if(Trush_posts() > 0)
                {
                    foreach($query as $record)
                    {   
                        Post::where('id', $record->id)->delete();
                        
                        if(Trush_posts() == 0)
                        {
                            return response()->json([
                                'message' => 'Cleaning uncompleted topics...',
                                'next_action' => 'clear_topics'
                            ]);
                        }
                    }
                
                }
                else
                {
                    return response()->json([
                        'message' => 'Cleaning uncompleted topics...',
                        'next_action' => 'clear_topics'
                    ]);
                }
                

                
                
            }
            elseif($request->post('action') == "clear_topics")
            {
                $query = topic::whereNotIn('cat_id',function ($SubQuery){
                    $SubQuery->select('id')->from('categories');
                })->get();

                if(Trush_topics() > 0)
                {
                    foreach($query as $record)
                    {   
                        topic::where('id', $record->id)->delete();
                        
                        if(Trush_topics() == 0)
                        {
                            return response()->json([
                                'message' => 'Celeaning the topic views...',
                                'next_action' => 'clear_topicviews'
                            ]);
                        }
                    } 
                }
                else
                {
                    return response()->json([
                        'message' => 'Celeaning the topic views...',
                        'next_action' => 'clear_topicviews'
                    ]);
                }


            }
            elseif($request->post('action') == "clear_topicviews")
            {
                $query = TopicViews::whereNotIn('topic_id',function ($SubQuery){
                    $SubQuery->select('id')->from('topics');
                })->get();

                if(Trush_topic_views() > 0)
                {
                    foreach($query as $record)
                    {   
                        TopicViews::where('id', $record->id)->delete();
                        
                        if(Trush_topic_views() == 0)
                        {
                            return response()->json([
                                'message' => 'Celeaning the polls...',
                                'next_action' => 'clear_polls'
                            ]);
                        }
                    }
                }
                else
                {
                    return response()->json([
                        'message' => 'Celeaning the polls...',
                        'next_action' => 'clear_polls'
                    ]);
                }

            }
            elseif($request->post('action') == "clear_polls")
            {
                $query = PollQuestion::whereNotIn('t_id',function ($SubQuery){
                    $SubQuery->select('id')->from('topics');
                })->get();

                if(Trush_polls() > 0)
                {
                    foreach($query as $record)
                    {   
                        PollQuestion::where('id', $record->id)->delete();
                        
                        if(Trush_polls() == 0)
                        {
                            return response()->json([
                                'message' => 'Celeaning the poll answers...',
                                'next_action' => 'clear_pollanswers'
                            ]);
                        }
                    }
                }
                else
                {
                    return response()->json([
                        'message' => 'Celeaning the poll answers...',
                        'next_action' => 'clear_pollanswers'
                    ]);
                }
                
                
            }
            elseif($request->post('action') == "clear_pollanswers")
            {
                $query = PollTaken::whereNotIn('poll_id',function ($SubQuery){
                    $SubQuery->select('id')->from('poll_question');
                })->get();

                if(Trush_poll_taken() > 0)
                {
                    foreach($query as $record)
                    {   
                        PollTaken::where('id', $record->id)->delete();
                        
                        if(Trush_poll_taken() == 0)
                        {
                            return response()->json([
                                'message' => 'Celeaning the reactions...',
                                'next_action' => 'clear_reactions'
                            ]);
                        }
                    }
                }
                else
                {
                    return response()->json([
                        'message' => 'Celeaning the reactions...',
                        'next_action' => 'clear_reactions'
                    ]);
                }

            }
            elseif($request->post('action') == "clear_reactions")
            {
                $query = PostReact::whereNotIn('reacted_at',function ($SubQuery){
                    $SubQuery->select('id')->from('posts');
                })->get();

                if(Trush_post_reactions() > 0)
                {
                    foreach($query as $record)
                    {   
                        PostReact::where('id', $record->id)->delete();
                        
                        if(Trush_post_reactions() == 0)
                        {
                            return response()->json([
                                'message' => 'Clearing deleted userd banlist...',
                                'next_action' => 'clear_banlist'
                            ]);
                        }
                    }
                }
                else
                {
                    return response()->json([
                        'message' => 'Clearing deleted userd banlist...',
                        'next_action' => 'clear_banlist'
                    ]);
                }

            }
            elseif($request->post('action') == "clear_banlist")
            {
                $query = Ban::whereNotIn('user_id',function ($SubQuery){
                    $SubQuery->select('id')->from('users');
                })->get();

                if(Trush_banned_list() > 0)
                {
                    foreach($query as $record)
                    {   
                        Ban::where('id', $record->id)->delete();    
                        
                        if(Trush_banned_list() == 0)
                        {
                            return response()->json([
                                'message' => 'Clearing the notifications...',
                                'next_action' => 'clear_notifications'
                            ]);
                        }
                    }
                }
                else
                {
                    return response()->json([
                        'message' => 'Clearing the notifications...',
                        'next_action' => 'clear_notifications'
                    ]);   
                }

            }
            elseif($request->post('action') == "clear_notifications")
            {
                $query = Notification::whereNotIn('user_to',function ($SubQuery){
                    $SubQuery->select('id')->from('users');
                })->get();

                if(Trush_notifications() > 0)
                {

                    foreach($query as $record)
                    {   
                        Notification::where('id', $record->id)->delete();    
                        
                        if(Trush_notifications() == 0)
                        {
                            return response()->json([
                                'message' => 'Clearing the dialogs...',
                                'next_action' => 'clear_dialogs'
                            ]);
                        }
                    }
                }
                else
                {
                    return response()->json([
                        'message' => 'Clearing the dialogs...',
                        'next_action' => 'clear_dialogs'
                    ]);
                }

            }
            elseif($request->post('action') == "clear_dialogs")
            {            
                $query = PMTopic::whereNotIn('starter',function ($SubQuery){
                    $SubQuery->select('id')->from('users');
                })
                ->whereNotIn('with_to',function ($SubQuery){
                    $SubQuery->select('id')->from('users');
                })->get();


                if(Trush_pm_topic() > 0)
                {
                    foreach($query as $record)
                    {   
                        PMTopic::where('id', $record->id)->delete();
                        
                        if(Trush_pm_topic() == 0)
                        {
                            return response()->json([
                                'message' => 'Clearing the PMs...',
                                'next_action' => 'clear_pms'
                            ]);
                        }
                    }

                }
                else
                {
                    return response()->json([
                        'message' => 'Clearing the PMs...',
                        'next_action' => 'clear_pms'
                    ]);
                }
                

            }
            elseif($request->post('action') == "clear_pms")
            {                
                $query = PMPost::whereNotIn('pmt_id',function ($SubQuery){
                    $SubQuery->select('id')->from('pm_topic');
                })->get();

                if(Trush_pm_post() > 0)
                {
                    foreach($query as $record)
                    {   
                        PMPost::where('id', $record->id)->delete();
                        
                        if(Trush_pm_post() == 0)
                        {
                            return response()->json([
                                'message' => 'Optimisation completed.',
                                'next_action' => 'completed'
                            ]);
                        }
                    }
                }
                else
                {
                    return response()->json([
                        'message' => 'Optimisation completed.',
                        'next_action' => 'completed'
                    ]);
                }

            }
        }
        else
        {
            return redirect()->route('home');
        }
        
    }



    // OptionBanDurations
    public function OptionBanDurations (Request $request)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            $query = BanTimes::orderBy('id','asc')->paginate(10);

            return view('admin.options.ban.durations', ['data' => $query]);
        
        }
        else
        {
            return redirect()->route('home');
        }
    
    }
    // End about us



     
    public function OptionBanDurations_edit (Request $request, $id=null)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            $result = BanTimes::where('id', $id)->get();

            if($result->count() < 1)
            {
                return redirect()->route('dashboard');
            }
            
            $error_message = null;

            if($request->isMethod('post'))
            {   
                $this->validate($request, [
                    'title' => 'required|min:3',
                    'duration' => 'required|min:1',
                ]);

                $arrayValues = [
                    'title' => $request->post('title'),
                    'duration_minutes' => $request->post('duration')
                ];
                
                $id = (int)$id;
                $query = BanTimes::where('id', $id)->update($arrayValues);

                if($query)
                {
                    return redirect()->route('admin.option.bandurations');
                }
                else
                {
                    $error_message = 'Oops, Something went wrong, please try again later...';
                }

            }
            $result = BanTimes::where('id', $id)->get();
            
            return view('admin.options.ban.edit', [
                'id' => (int)$id,
                'query' => $result, 
                'err_msg' => $error_message
            ]);
        
        }
        else
        {
            return redirect()->route('home');
        }
    
    }

    public function OptionBanDurations_delete (Request $request, $id=null)
    {
        if($user = Auth::user() && my('level') == 3)
        {
            $query = BanTimes::where('id', $id)->get();
            if($query->count()==1)
            {
                BanTimes::where('id', $id)->delete();
            }
            
            return redirect()->route('admin.option.bandurations');
        }
        else
        {
            return redirect()->route('home');
        }
    }
    
     
    public function OptionBanDurations_add (Request $request)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            $error_message = null;

            if($request->isMethod('post'))
            {   
                $this->validate($request, [
                    'title' => 'required|min:3',
                    'duration' => 'required|min:1',
                ]);

                $arrayValues = [
                    'title' => $request->post('title'),
                    'duration_minutes' => $request->post('duration'),
                    'created_at' => dayXnow(),
                    'updated_at' => dayXnow()
                ];
                
                $query = BanTimes::insert($arrayValues);

                if($query)
                {
                    return redirect()->route('admin.option.bandurations');
                }
                else
                {
                    $error_message = 'Oops, Something went wrong, please try again later...';
                }

            }
            
            
            return view('admin.options.ban.add', ['err_msg' => $error_message]);
        
        }
        else
        {
            return redirect()->route('home');
        }
    
    }

  
    public function OptionSocialShortcuts (Request $request)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            $query = Shortcuts::orderBy('id','asc')->paginate(10);

            return view('admin.options.shortcuts.list', ['data' => $query]);
        
        }
        else
        {
            return redirect()->route('home');
        }
    
    }



    public function OptionSocialShortcutsAdd (Request $request)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            $error_message = null;

            if($request->isMethod('post'))
            {   
                $this->validate($request, [
                    'title' => 'required|min:3',
                    'class_name' => 'required|min:3',
                    'icon_hex' => 'required|min:3'
                ]);
  
                $arrayValues = [
                    'title' => $request->post('title'),
                    'icon' => $request->post('class_name'),
                    'color' => $request->post('icon_hex'),
                    'created_at' => dayXnow(),
                    'updated_at' => dayXnow()
                ];
                
                $query = Shortcuts::insert($arrayValues);

                if($query)
                {
                    return redirect()->route('admin.option.social_shortcuts');
                }
                else
                {
                    $error_message = 'Oops, Something went wrong, please try again later...';
                }

            }
            
            
            return view('admin.options.shortcuts.add', ['err_msg' => $error_message]);
        
        }
        else
        {
            return redirect()->route('home');
        }
    
    }


    public function OptionSocialShortcutsEdit (Request $request, $id)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            $result = Shortcuts::where('id', $id)->get();

            if($result->count() < 1)
            {
                return redirect()->route('dashboard');
            }

            $error_message = null;

            if($request->isMethod('post'))
            {   
                $this->validate($request, [
                    'title' => 'required|min:3',
                    'class_name' => 'required|min:3',
                    'icon_hex' => 'required|min:3'
                ]);
  
                $arrayValues = [
                    'title' => $request->post('title'),
                    'icon' => $request->post('class_name'),
                    'color' => $request->post('icon_hex')
                ];
                
                $query = Shortcuts::where('id', $id)->update($arrayValues);

                if($query)
                {
                    return redirect()->route('admin.option.social_shortcuts');
                }
                else
                {
                    $error_message = 'Oops, Something went wrong, please try again later...';
                }

            }
            
            
            return view('admin.options.shortcuts.edit', ['id' => $id, 'err_msg' => $error_message]);
        
        }
        else
        {
            return redirect()->route('home');
        }
    
    }

    


    public function OptionSocialShortcutsDelete (Request $request, $id=null)
    {
        if($user = Auth::user() && my('level') == 3)
        {
            $query = Shortcuts::where('id', $id)->get();
            if($query->count()==1)
            {
                Shortcuts::where('id', $id)->delete();
            }
            
            return redirect()->route('admin.option.social_shortcuts');
        }
        else
        {
            return redirect()->route('home');
        }
    }



    // Stickers 
    public function OptionStickers (Request $request)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            $query = PMSmiles::orderBy('id','asc')->paginate(10);

            return view('admin.options.smiles.list', ['data' => $query]);
        
        }
        else
        {
            return redirect()->route('home');
        }
    
    }



    public function OptionStickersAdd (Request $request)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            $error_message = null;

            if($request->isMethod('post'))
            {   
                $this->validate($request, [
                    'title' => 'required|min:3',
                    'sticker_code' => 'required|min:3'
                ]);
  
                $arrayValues = [
                    'path' => $request->post('title'),
                    'code' => $request->post('sticker_code'),
                    'created_at' => dayXnow(),
                    'updated_at' => dayXnow()
                ];
                
                $query = PMSmiles::insert($arrayValues);

                if($query)
                {
                    return redirect()->route('admin.option.stickers');
                }
                else
                {
                    $error_message = 'Oops, Something went wrong, please try again later...';
                }

            }
            
            
            return view('admin.options.smiles.add', ['err_msg' => $error_message]);
        
        }
        else
        {
            return redirect()->route('home');
        }
    
    }


    public function OptionStickersEdit (Request $request, $id)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            $data = PMSmiles::where('id', $id)->limit(1)->get();
            
            if($data->count() < 1)
            {
                return redirect()->route('dashboard');
            }

            $error_message = null;

            if($request->isMethod('post'))
            {   
                $this->validate($request, [
                    'title' => 'required|min:3',
                    'sticker_code' => 'required|min:3'
                ]);
  
                $arrayValues = [
                    'path' => $request->post('title'),
                    'code' => $request->post('sticker_code')
                ];
                
                $query = PMSmiles::where('id', $id)->update($arrayValues);

                if($query)
                {
                    return redirect()->route('admin.option.stickers');
                }
                else
                {
                    $error_message = 'Oops, Something went wrong, please try again later...';
                }

            }
            
            
            return view('admin.options.smiles.edit', ['id' => $id, 'item' => $data, 'err_msg' => $error_message]);
        
        }
        else
        {
            return redirect()->route('home');
        }
    
    }
 
    public function OptionStickersDelete (Request $request, $id=null)
    {
        if($user = Auth::user() && my('level') == 3)
        {
            $query = PMSmiles::where('id', $id)->get();
            if($query->count()==1)
            {
                PMSmiles::where('id', $id)->delete();
            }
            
            return redirect()->route('admin.option.stickers');
        }
        else
        {
            return redirect()->route('home');
        }
    }



     
    public function OptionGeneral (Request $request)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            $error_message = null;

            if($request->isMethod('post'))
            {   
                $this->validate($request, [
                    'title' => 'required|min:3',
                    'slogan' => 'required|min:5',
                    'email' => 'required|min:6',

                    'maxt_main' => 'required|numeric|min:1|max:99',
                    'maxt_incat' => 'required|numeric|min:1|max:99',
                    'maxp_intopic' => 'required|numeric|min:1|max:299',
                    'max_xposts' => 'required|numeric|min:1|max:99',
                    'max_topics_profile' => 'required|numeric|min:1|max:99',
                    'max_memberlist' => 'required|numeric|min:1|max:99',
                    'max_searchperpage' => 'required|numeric|min:1|max:99',
                    'max_lasttpoicsCpDashboard' => 'required|numeric|min:1|max:99',
                    'cp_max_memberlist' => 'required|numeric|min:1|max:99',
                    'max_notifixations_dropdown' => 'required|numeric|min:1|max:99',
                    'max_notifixations_page' => 'required|numeric|min:1|max:99',
                    'max_contacts_dropdown' => 'required|numeric|min:1|max:99',
                    'max_pm_posts' => 'required|numeric|min:1|max:99',
                    'supporrttickets_perpage' => 'required|numeric|min:1|max:99',
                    
                ]);

                $arrayValues = [
                    'site_name' => $request->post('title'),
                    'slogan' => $request->post('slogan'),
                    'contact' => $request->post('email'),
                    'maxt_main' => $request->post('maxt_main'),
                    'maxt_incat' => $request->post('maxt_incat'),
                    'maxp_intopic' => $request->post('maxp_intopic'),
                    'max_xposts' => $request->post('max_xposts'),
                    'max_topics_profile' => $request->post('max_topics_profile'),
                    'max_memberlist' => $request->post('max_memberlist'),
                    'max_searchperpage' => $request->post('max_searchperpage'),
                    'max_lasttpoicsCpDashboard' => $request->post('max_lasttpoicsCpDashboard'),
                    'cp_max_memberlist' => $request->post('cp_max_memberlist'),
                    'max_notifixations_dropdown' => $request->post('max_notifixations_dropdown'),
                    'max_notifixations_page' => $request->post('max_notifixations_page'),
                    'max_contacts_dropdown' => $request->post('max_contacts_dropdown'),
                    'max_pm_posts' => $request->post('max_pm_posts'),
                    'supporrttickets_perpage' => $request->post('supporrttickets_perpage')
                ];
                
                $query = SysOption::where('id', 1)->update($arrayValues);

                if($query)
                {
                    return redirect()->route('admin.option.general');
                }
                else
                {
                    $error_message = 'Oops, Something went wrong, please try again later...';
                }

            }
            
            
            return view('admin.options.general', ['err_msg' => $error_message]);
        
        }
        else
        {
            return redirect()->route('home');
        }
    
    }


    public function OptionSeo (Request $request)
    {
        if($user = Auth::user() && my('level') == 3)
        { 
            $error_message = null;
 
            if($request->isMethod('post'))
            {    
                $description = $request->post('description');
                $keywords = $request->post('keywords');
                $additional_tags = $request->post('additional_tags');
                
                $values = [
                    'meta_description' => $description,
                    'meta_keywords' => $keywords,
                    'meta_additionalkeywords' => $additional_tags
                ];
 
                $query = SysOption::where('id', 1)->update($values);
 
                if($query)
                {
                    return redirect()->route('admin.option.seo');
                }
                else
                {
                    $error_message = 'Oops, Something went wrong, please try again later...';
                }
 
            }
            return view('admin.options.seo', ['err_msg' => $error_message]);
         
        }
        else
        {
            return redirect()->route('home');
        }
     
    }

}
