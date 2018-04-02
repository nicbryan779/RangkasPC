<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Exception;

class ProductController extends Controller
{
  protected $product;

  public function __construct(Product $product)
  {
    $this->product = $product;
  }

  public function register(Request $request)
  {
    $product = [
      "type"  => $request->type,
      "name"  => $request->name,
      "brand"  => $request->brand,
      "description"  => $request->description,
      "price"  => $request->price,
      "stock"  => $request->stock,
      "video" => $request->video
    ];

    try{
      $product = $this->product->create($product);
      return response('Created',201);
    }
    catch(Exception $ex){
      return response($ex,400);
    }
  }

  public function all()
  {
    try{
      $product = $this->product->all();
      return $product;
    }
    catch(Exception $ex){
      return response('Failed',400);
    }
  }

  public function find($id)
  {

    // $product = $this->product->where("id", "=", $id);
    try{
      $product = $this->product->find($id);
      return response('Found',200);
    }
    catch(Exception $ex){
      return response('Failed',400);
    }

  }
  public function delete($id)
  {

    try{
      $product = $this->product->where('id',$id)->delete();
      return response('Deleted',200);
    }
    catch(Exception $ex){
      return response('Failed',400);
    }

  }
  public function updateData(Request $request,$id)
  {
    $product = $this->product->find($id);

    $product->type = $request->input('type');
    $product->name = $request->input('name');
    $product->brand = $request->input('brand');
    $product->description = $request->input('description');
    $product->price = $request->input('price');
    $product->stock = $request->input('stock');
    $product->img = $request->input('img');
    $product->video = $request->input('video');
    try{
      $product->save();
      return response('Updated',200);
    }
    catch(Exception $ex){
      return response('Failed',400);
    }
  }
}
