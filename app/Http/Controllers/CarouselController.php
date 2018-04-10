<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carousel;

class CarouselController extends Controller
{
    protected $carousel;

    public function __construct(Carousel $carousel)
    {
      $this->carousel = $carousel;
    }

    public function getAll()
    {
      try {
          $carousel = $this->carousel->all();
          if($carousel->count()>0)
          {
            return response()->json(['success'=>true, 'carousel'=>$carousel]);
          }
          return response()->json(['success'=>false, 'messsage'=>'Data Not Found']);
      }
      catch (Exception $ex) {
        return response()->json(['success'=> false, 'message'=>'Unable to fetch carousel data']);
      }
    }
}
