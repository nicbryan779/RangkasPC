<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public $timestamps = false;
    protected $table="invoices";
    protected $fillable = ['user_id','total_price','total_item'];
    protected $hidden = [];
}
