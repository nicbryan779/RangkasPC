<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use DB;

class ProductController extends Controller
{
  protected $product;

  public function __construct(Product $product)
  {
    $this->product = $product;
  }
  public function find($id)
  {
    // $product = $this->product->where("id", "=", $id);
    try{
      $product = $this->product->where('id',$id)->first();
      if(!$product)
      {
        return response()->json(['success'=>false, 'message'=>'data not found'],400);
      }
      $product->views = $product->views+1;
      $product->save();
      return response()->json(['success'=>true,'data'=>$product],200);
    }
    catch(Exception $ex){
      return response()->json(['success'=>false, 'message'=>$ex],400);
    }
  }

  public function similar_products($id)
  {
    // $product = $this->product->where("id", "=", $id);
    try{
      $check = DB::table('products')->where('id',$id)->first();
      if(!$check)
      {
        return response()->json(['success'=>false, 'message'=>'data not found'],400);
      }
      print_r($check->gameplay);
      $product = $this->product->where('gameplay',$check->gameplay)->skip(1)->take(4)->get();
      foreach($product as $products)
      {
        $products->views = $products->views+1;
        $products->save();
      }
      return response()->json(['success'=>true,'data'=>$product],200);
    }
    catch(Exception $ex){
      return response()->json(['success'=>false, 'message'=>$ex],400);
    }
  }

  public function all()
  {
    // $product = $this->product->where("id", "=", $id);
    try{
      $product = $this->product->all();
      if(!$product)
      {
        return response()->json(['success'=>false, 'message'=>'data not found'],400);
      }
      return response()->json(['success'=>true,'data'=>$product],200);
    }
    catch(Exception $ex){
      return response()->json(['success'=>false, 'message'=>$ex],400);
    }
  }

  public function best_seller()
  {
    try {
      $product = $this->product->orderBy('sold',"DESC")->take(4)->get();
      return response()->json(['success'=>true, 'data'=>$product]);
    } catch (Exception $ex) {
      return response()->json(['success'=>false, 'error'=>$ex],400);
    }
  }
  public function popular()
  {
    try {
      $product = $this->product->orderBy('views',"DESC")->take(4)->get();
      return response()->json(['success'=>true, 'data'=>$product]);
    } catch (Exception $ex) {
      return response()->json(['success'=>false, 'error'=>$ex],400);
    }
  }
  public function new_release()
  {
    try {
      $product = $this->product->orderBy('created_at',"DESC")->take(4)->get();
      return response()->json(['success'=>true, 'data'=>$product]);
    } catch (Exception $ex) {
      return response()->json(['success'=>false, 'error'=>$ex],400);
    }
  }
  public function get_price($id)
  {
    try{
      $product = $this->product->where('id',$id)->first();
      if(!$product)
      {
        return response()->json(["success"=>false,"message"=>"item not found"]);
      }
      return $product->price;
    }
    catch (Exception $ex){
      return $ex;
    }
  }
  public function getProduct($id)
  {
    try{
      $product = $this->product->where('id',$id)->pluck('id','price','name');
      return $product;
    }
    catch (Exception $ex)
    {
      return $ex;
    }
  }
  public function checkStock($id,$amount)
  {
    try {
      $product = $this->product->where('id',$id)->first();
      if($product->stock < $amount)
      {
        return 0;
      }
      else {
        return 1;
      }
    } catch (Exception $ex) {
      return $ex;
    }
  }
  public function reduceStock($id,$amount)
  {
    $product = $this->product->where('id',$id)->first();
    if(!is_null($product))
    {
      $product->stock = $product->stock - $amount;
      $product->sold = $product->sold + $amount;
      $product->save();
    }
    return "DATA NOT FOUND";
  }
  public function getProductName($id)
  {
    try{
      $product = $this->product->where('id',$id)->pluck('name');
      return $product;
    }
    catch (Exception $ex)
    {
      return $ex;
    }
  }
}
