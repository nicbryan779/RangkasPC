<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Users;
use Exception;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator, DB, Hash, Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use App\Veritrans\Veritrans;

class InvoiceController extends Controller
{
  protected $invoice;
  protected $user;

  public function __construct(Invoice $invoice, Users $user)
  {
    $this->invoice=$invoice;
    $this->user = $user;
    Veritrans::$serverKey = 'SB-Mid-server-z0nTwV8vP6eYLqSh09mXOiG9';
    Veritrans::$isProduction = false;
  }

  public function register(Request $request)
  {
    try{
      $invoice = [
        'user_id'=> $request->id,
        'total_price'=> $request->price,
        'total_item'=> $request->amount
      ];
      $invoice = $this->invoice->create($invoice);
      return response()->json(['success'=>true, 'message'=>'Data Created!']);
    }
    catch(Exception $ex){
      return response()->json(['success'=>false, 'messsage'=>$ex],401);
    }
  }

  public function find($id)
  {
    try{
      $invoice = $this->invoice->find($id);
      if($invoice->count()<1)
      {
        return response()->json(['success'=>false, 'messsage'=>'Data Not Found'],401);
      }
      return response()->json(['success'=>true,'invoice'=>$invoice]);
    }
    catch(Exception $ex){
      return response()->json(['success'=>false, 'messsage'=>'Failed to get Data'],400);
    }
  }

  public function invoiceupdateadd($id,$price,$item)
  {
    try{
      $invoice = $this->invoice->where('id',$id)->first();
      $invoice->total_price = $invoice->total_price + ($price*$item);
      $invoice->total_item = $invoice->total_item + $item;
      $invoice->save();
    }
    catch (Exception $ex) {
      return $ex;
    }
  }
  public function invoiceupdateremove($id,$price,$item)
  {
    try{
      $invoice = $this->invoice->where('id',$id)->first();
      $invoice->total_price = $invoice->total_price - ($price*$item);
      $invoice->total_item = $invoice->total_item - $item;
      $invoice->save();
    }
    catch (Exception $ex) {
      return $ex;
    }
  }
  public function checkInvoice($id)
  {
    try {
      $invoice = $this->invoice->where('user_id',$id)->where('status',"Not Paid")->first();
      if(!$invoice)
      {
        return 0;
      }
      return $invoice->id;
    } catch (Exception $e) {
      return $e;
    }
  }
  public function createInvoice($user_id,$total_price,$total_item)
  {
    try{
      $invoice = [
        'user_id'=> $user_id,
        'total_price'=> $total_price,
        'total_item'=> $total_item
      ];
      $invoice = $this->invoice->create($invoice);
    }
    catch(Exception $ex){
      return response()->json(['success'=>false, 'messsage'=>$ex],401);
    }
  }

  public function transactions()
  {
    try{
      $user = auth()->user();
      $invoice = $this->invoice->where('user_id',$user->id)->where('status',"Paid")->leftjoin('orders',"invoices.id",'=','orders.invoice_id')->join('products','orders.product_id',"=",'products.id')->select("invoices.*","orders.amount","orders.total_price as subtotal","products.name","products.price","products.id as ProductID")->get();
      if(!$invoice)
      {
        return response()->json(["success"=>false,"message"=>"no data available"]);
      }
      return response()->json(["success"=>true,"data"=>$invoice]);
    }
    catch (Exception $ex)
    {
      return response()->json(["success"=>false,"message"=>$ex]);
    }
  }
  public function checkout(OrderController $order, AuthController $user1, ProductController $product, CodeController $code)
  {
      $user = auth()->user();
      $invoice  = $this->invoice->where('user_id',$user->id)->where('status',"Not Paid")->first();
      $vt = new Veritrans;
      $id = uniqid();
      $transaction_details = array(
              'order_id'          => $id,
              'gross_amount'  => $invoice->total_price
          );
      $invoice->payment_id=$id;
      $items = $order->getItems($invoice->id);
      $items_in_cart = $order->getCartItems($invoice->id);
      $invoice->save();
      foreach($items_in_cart as $item)
      {
        //return $product->checkStock($item->product_id,$item->amount);
        if(!$code->checkStock($item->product_id,$item->amount))
        {
          return response()->json(["success"=>false,"message"=>"Item Stock is not enough"],400);
        }
      }
      $billing_address = $user1->getAddress();
      $customer_details = array(
              'first_name'            => $user->name,
              'last_name'             => "",
              'email'                     => $user->email,
              'phone'                     => $user->phone,
              'billing_address' => $billing_address
              );
      $transaction_data = array(
              'payment_type'          => 'vtweb',
              'vtweb'                         => array(
              'credit_card_3d_secure' => true
              ),
              'transaction_details'=> $transaction_details,
              'item_details'           => $items,
              'customer_details'   => $customer_details
          );
      try
      {
        $vtweb_url = $vt->vtweb_charge($transaction_data);
        return redirect($vtweb_url);
      }
      catch (Exception $e)
      {
        return $e->getMessage();
      }
  }
  public function notification(Request $request,OrderController $order, ProductController $product, CodeController $code)
  {
      $vt = new Veritrans;
      $invoice = $this->invoice->where('payment_id',$request->order_id)->first();
      $invoice_id = $invoice->id;
      $items_in_cart = $order->getCartItems($invoice_id);
      $today = date('y-m-d');
      foreach($items_in_cart as $item){
        $product->reduceStock($item->product_id,$item->amount);
      }

      $user_id= $invoice->user_id;
      $invoice->payment_date=$today;
      $invoice->payment_type=$request->payment_type;
      $invoice->status = "Paid";
      $invoice->save();

      $user = $this->user->where('id',$user_id)->first();
      $email = $user->email;
      $name = $user->name;
      $subject = "Thank you for your purchase!";

      foreach($items_in_cart as $item){
        $product_name = $product->getProductName($item->product_id);
        for($i=0;$i<$item->amount;$i++)
        {
          $string  = $code->getCode($item->product_id);
          try {
            Mail::send('code', ['name'=>$name,'verification_code' => $string,'product_name'=> $product_name],
                function($mail) use ($email, $name, $subject){
                    $mail->from("rangkaspc@gmail.com","RangkasPC.me");
                    $mail->to($email, $name);
                    $mail->subject($subject);
                });
            $code->deleteCode($item->product_id);
          }
          catch (\Exception $e) {
          //Return with error
          $error_message = $e->getMessage();
          return response()->json(['success' => false, 'error' => $error_message], 401);
          }
        }
      }
      return response()->json(["success"=>true,"message"=>"Payment Complete!"],200);
  }
}
