<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $timestamps = false;
    protected $table= "admins";
    protected $fillable = ['username','password'];
    protected $hidden = ['password'];
}
