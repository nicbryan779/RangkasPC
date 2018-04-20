<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Codes extends Model
{
  public $timestamps = false;
  protected $table= "codes";
  protected $fillable = ['product_id','code'];
  protected $hidden = [];
}
