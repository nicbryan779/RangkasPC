<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Featured extends Model
{
  public $timestamps = false;
  protected $table= "featureds";
  protected $fillable = ['product_id'];
  protected $hidden = [];
}
