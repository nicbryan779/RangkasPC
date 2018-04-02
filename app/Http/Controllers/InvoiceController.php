<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use Exception;

class InvoiceController extends Controller
{
  protected $invoice;

  public function __construct(InvoiceModel $invoice)
  {
    $this->invoice = $invoice;
  }

  public function register(Request $request)
  {
    $invoice = [
      "user_id"  => $request->user_id,
      "total_price"  => $request->total_price,
      "total_item"  => $request->total_item
    ];
    try{
      $invoice = $this->invoice->create($invoice);
      return response('Created',201);
    }
    catch(Exception $ex){
      return response('Failed',400);
    }
  }

  public function all()
  {
    try{
      $invoice = $this->invoice->all();
      return $invoice;
    }
    catch(Exception $ex){
      return response('Failed',400);
    }
  }

  public function find($id)
  {

    // $Invoice = $this->Invoice->where("id", "=", $id);
    try{
      $invoice = $this->invoice->find($id);
      return response('Found',200);
    }
    catch(Exception $ex){
      return response('Failed',400);
    }

  }
  public function delete($id)
  {

    try{
      $invoice = $this->invoice->where('id',$id)->delete();
      return response('Deleted',200);
    }
    catch(Exception $ex){
      return response('Failed',400);
    }

  }
  public function updateData(Request $request,$id)
  {
    $invoice = $this->invoice->find($id);

    $invoice->user_id = $request->input('user_id');
    $invoice->total_price = $request->input('total_price');
    $invoice->total_item = $request->input('total_item');
    try{
      $invoice->save();
      return response('Updated',200);
    }
    catch(Exception $ex){
      return response('Failed',400);
    }
  }
}
