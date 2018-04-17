<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{

    use Searchable;

    public $timestamps = true;
    protected $table = "products";
    protected $fillable = ['type','name','brand','description','price','stock','sold','img','video'];
    protected $hidden = [];

    public function toSearchableArray()
      {
            $user = $this->toArray();
            unset($user['sold'], $user['img'],$user['video'],$user['id'],$user['stock'],$user['created_at'],$user['updated_at'],$user['ObjectID']);
            return $user;
      }
}
