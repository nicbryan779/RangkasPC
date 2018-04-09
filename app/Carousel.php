<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
  public $timestamps = false;
  protected $table= "carousels";
  protected $fillable = ['name','url','caption'];
  protected $hidden = [];
}
