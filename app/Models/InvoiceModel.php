<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceModel extends Model
{
  public $timestamps = false;
  protected $table = "invoices";
  protected $fillable = ['user_id', 'total_price', 'total_item'];
  protected $guarded = [];
}
