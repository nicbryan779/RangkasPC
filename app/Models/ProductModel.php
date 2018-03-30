<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
  public $timestamps = false;
  protected $table = "products";
  protected $fillable = ['type', 'name', 'brand', 'description', 'port', 'price', 'stock'];
  protected $guarded = [];
}
