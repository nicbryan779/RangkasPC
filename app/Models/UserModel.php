<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
  public $timestamps = false;
  protected $table = "users";
  protected $fillable = ['name', 'email', 'password', 'birthdate', 'phone', 'address', 'city', 'state', 'zip'];
  protected $guarded = [];
}
