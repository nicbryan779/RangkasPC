<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public $timestamps = false;
    protected $table="invoices";
    protected $fillable = ['user_id','total_price','total_item','status','payment_id'];
    protected $hidden = [];

    public function order()
    {
        return $this->hasMany('App\Order');
    }
}
