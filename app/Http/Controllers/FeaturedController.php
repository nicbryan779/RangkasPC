<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Featured;

class FeaturedController extends Controller
{
    protected $featured;

    public function __construct(Featured $featured)
    {
      $this->featured = $featured;
    }

    public function getAll()
    {
      try {
          $featured = $this->featured->all();
          if($featured->count() < 1)
          {
            return response()->json(['success'=>false, 'messsage'=>'Data Not Found']);
          }
          return response()->json(['success'=>true, 'featured'=>$featured]);
      }
      catch (Exception $e) {
        return response()->json(['success'=> false, 'message'=>'Unable to fetch featured data']);
      }
    }
}
