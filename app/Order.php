<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $table="orders";
    protected $fillable = ['invoice_id','product_id','total_price','amount'];
    protected $hidden = [];
}
