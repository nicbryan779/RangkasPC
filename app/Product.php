<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = true;
    protected $table="products";
    protected $fillable = ['type','name','brand','description','price','stock','sold','img','video'];
    protected $hidden = [];
}
