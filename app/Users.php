<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    public $timestamps = false;
    protected $table="users";
    protected $filleable = ['id','name','email','password','birthdate','phone','address','city','state','zip'];
    protected $hidden = ['password'];
}
