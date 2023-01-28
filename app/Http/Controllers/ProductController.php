<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\File;

use App\Models\product;

use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller
{
    public function saveProduct(ProductFormRequest $request){

        $data=$request->validated();

        $product=new product;

        $product->user_id=Auth::user()->id;
        $product->name=$data['name'];
        $product->description=$data['description'];
        $product->price=$data['price'];

        if($request->hasfile('image')){
            $file=$request->file('image');
            $filename=time().'.'.$file->getClientOriginalExtension();
            $file->move('uploads/products/',$filename);
            $product->image=$filename;
        }

        $product->save();

        return redirect(route('product.all'))->with('status','Product Saved Successfully');

    }
      public function viewAllProduct(){

        $products=Product::where('user_id',Auth::user()->id)->get();
        return view('products.all-products',compact('products'));

      }

      public function editProduct($product_id){
        $product=Product::find($product_id);
        return view('products.edit-product',compact('product'));
      }

      public function updateProduct(ProductFormRequest $request,$product_id){
          
        $data=$request->validated();

        $product=Product::findOrFail($product_id);

        $product->name=$data['name'];
        $product->description=$data['description'];
        $product->price=$data['price'];;

        if($request->hasfile('image')){

            $destination ='uploads/products/'.$product->image;
            if(File::exists($destination)){
                 File::delete($destination);
            }

             $file=$request->file('image');
             $filename=time().'.'.$file->getClientOriginalExtension();
             $file->move('uploads/products/',$filename);
             $product->image=$filename;
        }
        
        $product->update();

        return redirect(route('product.all'))->with('status','Product Updated Successfully');

    }

    public function deleteProduct(Request $request){
         
        $product=product::findOrFail($request->product_delete_id);

        if($product){
            $destination ='uploads/products/'.$product->image;
            if(File::exists($destination)){
                 File::delete($destination);
            }
            $product->delete();
            return redirect(route('product.all'))->with('status','Product Deleted Successfully');
        }
        else{
            return redirect(route('product.all'))->with('message','Product ID Not Found');
        }
    }
    
}
