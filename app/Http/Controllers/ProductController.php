<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Image;

class ProductController extends Controller
{

    public function get_all_product()
    {
        $products = Product::all();
        return response()->json([
            'products' => $products
        ],200);
    }

    public function create()
    {
        //
    }

    public function addProduct(Request $request)
    {
        $product = new Product();

//        if($request->photo != ""){
//            $strpos = strpos($request->photo,';');
//            $sub = substr($request->photo,0,$strpos);
//            $ex = explode('/',$sub)[1];
//            $name = time().".".$ex;
//            $img = Image::make($request->photo)->resize(200,200);
//            $upload_path = public_path()."/upload/";
//            $img->save($upload_path.$name);
//            $product->photo = $name;
//        }
//        else{
//            $product->photo = "image.png";
//        }
//        $document = $request->file('photo');
//        $document_name = rand().'.'.$document->getClientOriginalExtension();
//        $document->move(public_path().'/upload/',$document_name);

        $product->name=$request->name;
        $product->description=$request->description;

//        $product->photo=$document_name;
        $product->photo="image.png";
        $product->type=$request->type;
        $product->quantity=$request->quantity;
        $product->price=$request->price;
        $product->save();

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $product = Product::find($id);
        return response()->json([
            'product' => $product
        ],200);
    }


    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name=$request->name;
        $product->description=$request->description;

//        $product->photo=$document_name;
        $product->photo="image.png";

        $product->type=$request->type;
        $product->quantity=$request->quantity;
        $product->price=$request->price;
        $product->save();

//        $document = $request->file('photo');
//        $document_name = rand().'.'.$document->getClientOriginalExtension();
//        $document->move(public_path().'/upload/',$document_name);


    }


    public function destroy($id)
    {
        $product = Product::find($id);
        $image_path = public_path()."/upload/";
        $image = $image_path. $product->photo;
        if(file_exists($image)){
            @unlink($image);
        }
        $product->delete();
    }
}
