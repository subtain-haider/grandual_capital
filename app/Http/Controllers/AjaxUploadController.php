<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AjaxUploadController extends Controller
{
    function action(Request $request)
    {  
        if ($user = Auth::user())
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

               $image->move(public_path('upload/attachments'), $new_name);
               

               $file_name = urlencode(pathinfo($original_filename, PATHINFO_FILENAME));
               $file_url = route('download_file', [$file_name,$new_name]);

               return response()->json([
                   'message'   => 'Image Upload Successfully',
                   'uploaded_image' => '<tr id="file_'.$rand_num.'"><td style="padding:5px !important;"><a href="'.$file_url.'" style="padding:5px 7px !important;" class="list-group-item list-group-item-action">'.$original_filename.' <span class="badge badge-primary badge-pill">'.$filesize.'</span></a></td><td style="padding:7px !important;"><div class="btn btn-light btn-outline-secondary btn-sm" onClick="del_attach('.$newfile.');"><i class="fas fa-times"></i></div></td></tr>',
                   'class_name'  => 'alert-success',
                   'linkin_attach' => '<a id="attach_'.$rand_num.'" href="'.$file_url.'" id="attach_'.$rand_num.'">'.$original_filename.' <span class="badge badge-primary badge-pill">'.$filesize.'</span></a>'
                   ]);
                   
            }
            else
            {
                return response()->json([
                    'message'   => $validation->errors()->all(),
                    'uploaded_image' => '',
                    'class_name'  => 'alert-danger',
                    'linkin_attach' => ''
                ]);
            }
        }
        else
        {
            return redirect()->route('index');   
        }

    }




    function UploadAction(Request $request)
    {
        if ($user = Auth::user())
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

                $image->move(public_path('upload/attachments'), $new_name);
                

                $file_name = urlencode(pathinfo($original_filename, PATHINFO_FILENAME));
                $file_url = route('download_file', [$file_name,$new_name]);

                return response()->json([
                   'message' => 'Image Upload Successfully',
                   'uploaded_file' => $file_url
                ]);  
            }
            else
            {
                return response()->json([
                    'message' => $validation->errors()->all(),
                    'uploaded_file' => 0
                ]);
            }
        }
        else
        {
            return redirect()->route('index');   
        }

    }




    function upavatar(Request $request)
    {   
        if($user = Auth::user())
        {
            $data = $request->post('avatar');      
            $mod_user = (int)$request->post('moderate_user');  
            $img = $data;
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
        
            $file = '/upload/avatars/'.time() . '.png';
            $movefile = file_put_contents(public_path().$file, $data);

            if($movefile)
            {   
                // moderate_user
                if(my('level') == 3 && $mod_user >= 1)
                {
                    User::where('id', $mod_user)->update(['avatar' => $file]);
                }
                else
                {
                    User::where('id', myid())->update(['avatar' => $file]);
                }
                
                return response()->json([
                    'message' => 'Avatar changed successfully',
                    'file_url' => $file
                ]);

            }
            else
            {
                return response()->json([
                    'message' => 'Error occured, try again',
                    'file_url' => '0'
                ]);
            }
        }
        else
        {
            return redirect()->route('home');
        }
        
        
    }

    function upa()
    {
        return view('file.upload-avatar');
    }

    function dell_attachment(Request $request){
        
        if ($user = Auth::user())
        { 
            $validation = Validator::make($request->all(), [
                'file' => 'required|min:6',
                'extension' => 'required|min:3'
            ]);

            if($validation->passes())
            {
                $thefile = $request->post('file');
                $extension = $request->post('extension');
            
                //start delete file
                $path = public_path()."/upload/attachments/".$thefile.'.'.$extension;
                if(unlink($path))
                {
                    return response()->json([
                        'del_status' => 1,
                        'message' => 'File deleted successfully',
                        'file' => $thefile
                    ]);
                }
                //end delete file
            }
        }
        else
        {
            return redirect()->route('home');
        }
        
    }


    
    function download(Request $request, $filename, $thefile)
    {
            $filePath = public_path("upload/attachments/".$thefile);
            $file_name = urldecode($filename);
            
            if(!is_readable($filePath)) die('File not found or inaccessible!');
    
            $known_mime_types=array(
                "zip" => "application/zip",
                "doc" => "application/msword",
                "jpg" => "image/jpg",
                "gif" => "image/gif",
                "pdf" => "application/pdf",
                "txt" => "text/plain",
                "png" => "image/png",
                "jpeg"=> "image/jpg"
            );

            $file_extension = strtolower(substr(strrchr($filePath,"."),1));
            
            if(array_key_exists($file_extension, $known_mime_types)){
                $mime_type=$known_mime_types[$file_extension];

                $headers = ['Content-Type: '.$mime_type];
                
                $fileName = $file_name.'.'.$file_extension;
                return response()->download($filePath, $fileName, $headers);
                
            }

      
    }


}
?>