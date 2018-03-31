<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $table="orders";
    protected $filleable = ['id','invoice_id','product_id','total_price','status'];
    protected $hidden = [];
}
