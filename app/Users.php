<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    public $timestamps = false;
    protected $table="users";
    protected $fillable = ['name','email','password','birthdate','phone','address','city','state','zip','token','status'];
    protected $hidden = ['password'];
}
