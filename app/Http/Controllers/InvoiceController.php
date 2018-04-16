<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use Exception;use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator, DB, Hash, Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;

class InvoiceController extends Controller
{
  protected $invoice;

  public function __construct(Invoice $invoice)
  {
    $this->invoice=$invoice;
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
}
