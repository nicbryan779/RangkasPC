<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;

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
      $product = $this->product->find($id);
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
  public function most_featured()
  {
    try {
      $product = $this->product->orderBy('sold',"DESC")->take(2)->get();
      return response()->json(['success'=>true, 'data'=>$product]);
    } catch (Exception $ex) {
      return response()->json(['success'=>false, 'error'=>$ex],400);
    }
  }
  public function new_release()
  {
    try {
      $product = $this->product->orderBy('created_at',"DESC")->take(2)->get();
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
}
