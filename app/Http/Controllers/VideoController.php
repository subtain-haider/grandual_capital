<?php

namespace App\Http\Controllers;

use App\Models\Videos;
use Illuminate\Http\Request;
use App\Models\VideoCategories;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Videos::all();
        return view('admin.video.video',compact('products'));
    }
    public function user_video()
    {
        $vid_categories = VideoCategories::all();
        $videos = Videos::all();
        return view('user.video.video',compact('vid_categories', 'videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = VideoCategories::all();
        return view('admin.video.addVideo',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $video = new Videos();
        if($request->file('video')) {
            $fileName = time() . $request->video->getClientOriginalName();
            $filePath = $request->file('video')->storeAs('videos', $fileName, 'public');
            $video->video_link = $filePath;
        }
        $video->video_title = $request->name;
        $video->description = $request->one_description;
//        $video->video_link = $request->video;
        $video->video_categories_id = $request->category_id;
        $video->save();

        return redirect()->route('admin.video');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorys = VideoCategories::all();
        $product = Videos::findOrFail($id);
        return view('admin.video.editVideo',compact('product','categorys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $video = Videos::where('id',$id)->first();
        if($request->file('video')) {
            $fileName = time() . $request->video->getClientOriginalName();
            $filePath = $request->file('video')->storeAs('videos', $fileName, 'public');
            $video->video_link = $filePath;
        }
        $video->video_title = $request->name;
        $video->description = $request->one_description;
//        $video->video_link = $request->video;
        $video->video_categories_id = $request->category_id;
        $video->save();
        return redirect()->route('admin.video');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Videos::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.video');
    }

    // public function product($id){
    //     $product = Product::find($id);
    //     return view('product',compact('product'));
    // }
    // public function products(){
    //     $products = Product::all();
    //     $categories = Category::all();
    //     return view('products',compact('categories','products'));
    // }
    // public function f_products(){
    //     $products = Product::where('featured',1)->get();
    //     $categories = Category::all();
    //     return view('products',compact('categories','products'));
    // }
    // public function image_upload(Request $request){
    //     $product = new Product();
    //     $product->id = 0;
    //     $product->exists = true;
    //     $image = $product->addMediaFromRequest('upload')->toMediaCollection('images');

    //     return response()->json([
    //         'url' => $image->getUrl()
    //     ]);
    // }
}
