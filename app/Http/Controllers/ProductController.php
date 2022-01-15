<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.product.product',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.addproduct',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product = new Product();
        $product->name = $request->name;
        $product->one_description = $request->one_description;
        $product->description = $request->description;
        $product->featured = $request->featured;
        $product->key = $request->key;
        $product->video = $request->video;
        $product->p_category_id = $request->category_id;

        if($request->file()) {
            if($request->file('image')) {
                $fileName = time() . $request->image->getClientOriginalName();
                $filePath = $request->file('image')->storeAs('products', $fileName, 'public');
                $product->image = $filePath;
            }

            if($request->file('gallery')) {
                $gallery = '';
                foreach ($request->gallery as $image) {
                    $fileName = time() . $image->getClientOriginalName();
                    $filePath = $image->storeAs('products', $fileName, 'public');
                    $gallery = $gallery . ',' . $filePath;
                }
                $product->gallery = trim($gallery, ',');
            }

            if($request->file('download_file')) {
                $fileName = time() . $request->download_file->getClientOriginalName();
                $filePath = $request->file('download_file')->storeAs('products/files', $fileName, 'public');
                $product->file = $filePath;
            }
        }
        $product->save();

        return redirect()->route('products.index');
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
        $categorys = Category::all();
        $product = Product::findOrFail($id);
        return view('admin.product.editproduct',compact('product','categorys'));
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
        $product = Product::where('id',$id)->first();
        $product->name = $request->name;
        $product->one_description = $request->one_description;
        $product->description = $request->description;
        $product->featured = $request->featured;
        $product->key = $request->key;
        $product->video = $request->video;
        $product->p_category_id = $request->category_id;
        if($request->file('image')) {
//            $image_path = public_path('/').'/'.$product->image;
//            if (file_exists($image_path)) {
//                unlink($image_path);
//            }
            $fileName = time() . $request->image->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('products', $fileName, 'public');
            $product->image = $filePath;
        }
        if($request->file('gallery')) {
//            $images =  explode(',', $product->gallery);
//            foreach ($images as $image){
//                $gallery = public_path('/').'/'.$image;
//                if (file_exists($gallery)){
//                    unlink($gallery);
//                }
//            }


            $gallery = '';
            foreach ($request->gallery as $image) {
                $fileName = time() . $image->getClientOriginalName();
                $filePath = $image->storeAs('products', $fileName, 'public');
                $gallery = $gallery . ',' . $filePath;
            }
            $product->gallery = trim($gallery, ',');
        }


        if($request->file('download_file')) {
            $image_path = public_path('/').'/'.$product->file;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $fileName = time() . $request->download_file->getClientOriginalName();
            $filePath = $request->file('download_file')->storeAs('products/files', $fileName, 'public');
            $product->file = $filePath;
        }
        $product->save();
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $image_path = public_path('/').'/'.$product->image;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $images =  explode(',', $product->gallery);
            foreach ($images as $image){
                $gallery = public_path('/').'/'.$image;
                if (file_exists($gallery)){
                    unlink($gallery);
                }
            }



            $image_path = public_path('/').'/'.$product->file;
            if (file_exists($image_path)) {
                unlink($image_path);
            }


        $product->delete();
        return redirect('admin/products');
    }

    public function product($id){
        $product = Product::find($id);
        return view('product',compact('product'));
    }
    public function products(){
        $products = Product::all();
        $categories = Category::all();
        return view('products',compact('categories','products'));
    }
    public function f_products(){
        $products = Product::where('featured',1)->get();
        $categories = Category::all();
        return view('products',compact('categories','products'));
    }
    public function image_upload(Request $request){
        $product = new Product();
        $product->id = 0;
        $product->exists = true;
        $image = $product->addMediaFromRequest('upload')->toMediaCollection('images');

        return response()->json([
            'url' => $image->getUrl()
        ]);
    }
}
