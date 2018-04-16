<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
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
    }

    public function addToCart(Request $request,$id, ProductController $product, InvoiceController $invoice)
    {
      try{
        $user = auth()->user();
        $price = $product->get_price($id);
        $invoice_id = $invoice->checkInvoice($user->id);
        $amount = $request->amount;
        $total=$price*$amount;
        if($invoice_id==0)
        {
          $invoice->createInvoice($user->id,$total,$amount);
          $invoice_id = $invoice->checkInvoice($user->id);
        }
        else
        {
          $invoice->invoiceupdateadd($invoice_id,$price,$amount);
        }
        $order = $this->order->where('invoice_id',$invoice_id)->where('product_id',$id)->first();
        if(is_null($order))
        {
          $order = [
            'invoice_id'=>$invoice_id,
            'product_id'=>$id,
            'total_price'=>$amount*$price,
            'amount'=>$amount
          ];
          $order = $this->order->create($order);
        }
        else {
          $order->amount = $order->amount + $amount;
          $order->total_price = $order->total_price + ($price*$amount);
          $order->save();
        }

        return response()->json(["success"=>true, "message"=>"successfully added to cart"]);
      }
      catch(Exception $ex)
      {
        return response()->json(["success"=>false, "error"=>$ex]);
      }
    }
    public function removefromcart($id,ProductController $product, InvoiceController $invoice)
    {
      try {
        $user = auth()->user();
        $order = $this->order->where('id',$id)->first();
        if(!$order){
          return response()->json(['success'=>false, 'message'=>"There is none of the specified item in the cart"]);
        }
        $invoice_id = $order->invoice_id;
        $price = $product->get_price($order->product_id);
        if($order->amount<2)
        {
          $order = $this->order->where('id',$id)->delete();
        }
        else {
          $order->amount = $order->amount - 1;
          $order->total_price = $order->total_price-$price;
          $order->save();
        }
        $invoice->invoiceupdateremove($invoice_id,$price,1);
        return response()->json(['success'=>true,"message"=>"Successfully removed from cart"]);
      } catch (Exception $e) {
        return response()->json(['success'=>false,"message"=>"Failed to remove from cart"],400);
      }
    }

    public function add1item($id,ProductController $product, InvoiceController $invoice)
    {
      try {
        $user = auth()->user();
        $order = $this->order->where('id',$id)->first();
        $price = $product->get_price($order->product_id);
        $order->amount = $order->amount+1;
        $order->total_price = $order->total_price + $price;
        $invoice->invoiceupdateadd($order->invoice_id,$price,1);
        $order = $order->save();
        return response()->json(["success"=>true, "message"=>"Added to cart"]);
      } catch (Exception $ex) {
          return response()->json(["success"=>false,"message"=>$ex]);
      }
    }

    public function viewcart(InvoiceController $invoice)
    {
      try{
        $user = auth()->user();
        $invoice_id = $invoice->checkInvoice($user->id);
        if($invoice_id==0)
        {
          return response()->json(["success"=>true,"data"=>[]]);
        }
        $order = $this->order->where('invoice_id',$invoice_id)->with('product')->get();
        return response()->json(["success"=>true,"data"=>$order]);
      }
      catch (Exception $ex){
        return response()->json(["success"=>false,"error"=>$ex]);
      }
    }
}
