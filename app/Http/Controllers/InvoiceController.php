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
}
