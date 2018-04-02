<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $table="products";
    protected $fillable = ['type','name','brand','description','port','price','stock'];
    protected $hidden = [];
}
