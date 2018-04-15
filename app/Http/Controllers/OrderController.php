<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Users;
use App\Invoice;
use App\Product;
use Exception;use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator, DB, Hash, Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;

class OrderController extends Controller
{
    protected $order;
    protected $user;
    protected $invoice;
    protected $product;

    public function __construct(Order $order,Users $user, Invoice $invoice, Product $product)
    {
      $this->order=$order;
      $this->user = $user;
      $this->invoice = $invoice;
      $this->product = $product;
    }

    public function addToCart(Request $request,$id)
    {
      try{
        $user = auth()->user();
        $product = $this->product->where('id',$id)->first();
        if(!$product)
        {
          return response()->json(["success"=>false, "message"=>"Item not found!"]);
        }
        $invoice = $this->invoice->where('user_id',$user->id)->where('status',"Not Paid")->first();
        $total= (int)$product->price*(int)$request->amount;
        if(!$invoice)
        {
          $invoice = [
            'user_id'=>$user->id,
            'total_price'=> $total,
            'total_item'=> (int)$request->amount,
          ];
          $invoice = $this->invoice->create($invoice);
        }
        else
        {
          $invoice->total_price = $invoice->total_price + $total;
          $invoice->total_item = $invoice->total_item + (int)$request->get('amount');
          $invoice->save();
        }
        $order = [
          'invoice_id'=>$invoice->id,
          'product_id'=>$id,
          'total_price'=>$request->amount*$product->price,
          'amount'=>$request->amount
        ];
        $order = $this->order->create($order);
        return response()->json(["success"=>true, "message"=>"successfully added to cart"]);
      }
      catch(Exception $ex)
      {
        return response()->json(["success"=>false, "error"=>$ex]);
      }
    }
    public function removefromcart($id)
    {
      try {
        $user = auth()->user();
        $order = $this->order->where('id',$id)->first();
        if(!$order){
          return response()->json(['success'=>false, 'message'=>"There is none of the specified item in the cart"]);
        }
        $invoice_id = $order->invoice_id;
        $product = $this->product->where('id',$order->product_id)->first();
        if($order->amount<2)
        {
          $order = $this->order->where('id',$id)->delete();
        }
        else {
          $order->amount = $order->amount - 1;
          $order->total_price = $order->total_price-$product->price;
          $order->save();
        }
        $invoice = $this->invoice->where('id',$invoice_id)->first();
        $invoice->total_item = $invoice->total_item - 1;
        $invoice->total_price = $invoice->total_price - $product->price;
        $invoice->save();
        return response()->json(['success'=>true,"message"=>"Successfully removed from cart"]);
      } catch (Exception $e) {
        return response()->json(['success'=>false,"message"=>"Failed to remove from cart"]);
      }

    }
}
