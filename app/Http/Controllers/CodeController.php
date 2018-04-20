<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Codes;

class CodeController extends Controller
{
    protected $code;

    public function __construct(Codes $code)
    {
      $this->code = $code;
    }

    public function getCode($id)
    {
      $code = $this->code->where('product_id',$id)->first();
      return $code->code;
    }

    public function deleteCode($id)
    {
      $code = $this->code->where('product_id',$id)->first()->delete();
    }

    public function checkStock($id,$amount)
    {
      $stock = $this->code->where('product_id',$id)->count();
      if($stock<$amount)
      {
        return 0;
      }
      else {
        return 1;
      }
    }
}
