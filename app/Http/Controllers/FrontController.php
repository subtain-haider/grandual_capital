<?php

namespace App\Http\Controllers;

use App\Models\Front;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function front(){
        $front = Front::first();
        return view('admin.front.index',compact('front'));
    }

    public function front_post(Request $request){
        $front = Front::first();
        if($request->file('header_image')) {
            $image_path = public_path('/').'/front_images/'.$request->header_image;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $fileName = time() . $request->header_image->getClientOriginalName();
            $filePath = $request->file('header_image')->storeAs('front_images', $fileName, 'public');
            $front->update([
                'header_image' => $filePath
            ]);
        }
        if($request->file('how_it_works_image')) {
            $image_path = public_path('/').'/front_images/'.$request->how_it_works_image;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $fileName = time() . $request->how_it_works_image->getClientOriginalName();
            $filePath = $request->file('how_it_works_image')->storeAs('front_images', $fileName, 'public');
            $front->update([
                'how_it_works_image' => $filePath
            ]);
        }
        if($request->file('team_image_1')) {
            $image_path = public_path('/').'/front_images/'.$request->team_image_1;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $fileName = time() . $request->team_image_1->getClientOriginalName();
            $filePath = $request->file('team_image_1')->storeAs('front_images', $fileName, 'public');
            $front->update([
                'team_image_1' => $filePath
            ]);
        }
        if($request->file('team_image_2')) {
            $image_path = public_path('/').'/front_images/'.$request->team_image_2;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $fileName = time() . $request->team_image_2->getClientOriginalName();
            $filePath = $request->file('team_image_2')->storeAs('front_images', $fileName, 'public');
            $front->update([
                'team_image_2' => $filePath
            ]);
        }
        if($request->file('team_image_3')) {
            $image_path = public_path('/').'/front_images/'.$request->team_image_3;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $fileName = time() . $request->team_image_3->getClientOriginalName();
            $filePath = $request->file('team_image_3')->storeAs('front_images', $fileName, 'public');
            $front->update([
                'team_image_3' => $filePath
            ]);
        }
        if($request->file('team_image_4')) {
            $image_path = public_path('/').'/front_images/'.$request->team_image_4;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $fileName = time() . $request->team_image_4->getClientOriginalName();
            $filePath = $request->file('team_image_4')->storeAs('front_images', $fileName, 'public');
            $front->update([
                'team_image_4' => $filePath
            ]);
        }
        if($request->file('second_last_image')) {
            $image_path = public_path('/').'/front_images/'.$request->second_last_image;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $fileName = time() . $request->second_last_image->getClientOriginalName();
            $filePath = $request->file('second_last_image')->storeAs('front_images', $fileName, 'public');
            $front->update([
                'second_last_image' => $filePath
            ]);
        }
        if($request->file('testimonial_image_1')) {
            $image_path = public_path('/').'/front_images/'.$request->testimonial_image_1;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $fileName = time() . $request->testimonial_image_1->getClientOriginalName();
            $filePath = $request->file('testimonial_image_1')->storeAs('front_images', $fileName, 'public');
            $front->update([
                'testimonial_image_1' => $filePath
            ]);
        }
        if($request->file('testimonial_image_2')) {
            $image_path = public_path('/').'/front_images/'.$request->testimonial_image_2;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $fileName = time() . $request->testimonial_image_2->getClientOriginalName();
            $filePath = $request->file('testimonial_image_2')->storeAs('front_images', $fileName, 'public');
            $front->update([
                'testimonial_image_2' => $filePath
            ]);
        }
        if($request->file('testimonial_image_3')) {
            $image_path = public_path('/').'/front_images/'.$request->testimonial_image_3;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $fileName = time() . $request->testimonial_image_3->getClientOriginalName();
            $filePath = $request->file('testimonial_image_3')->storeAs('front_images', $fileName, 'public');
            $front->update([
                'testimonial_image_3' => $filePath
            ]);
        }
        if($request->file('testimonial_image_4')) {
            $image_path = public_path('/').'/front_images/'.$request->testimonial_image_4;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $fileName = time() . $request->testimonial_image_4->getClientOriginalName();
            $filePath = $request->file('testimonial_image_4')->storeAs('front_images', $fileName, 'public');
            $front->update([
                'testimonial_image_4' => $filePath
            ]);
        }


        $front->update($request->except('_token','header_image', 'how_it_works_image', 'team_image_1','team_image_2','team_image_3','team_image_4','second_last_image'));
        return back();
    }
}
