<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $timestamps = false;
    protected $table="admin";
    protected $filleable = ['id','username','password'];
    protected $hidden = ['password'];
}
