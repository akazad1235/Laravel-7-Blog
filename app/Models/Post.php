<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
 
 		protected $fillable = [
        'user_id', 'category_id', 'title','content', 'thumbnail', 'status',
            ];


    public function category(){
    	return $this->belongsTo(Category::class, 'category_id', 'id');
    }

     public function user(){
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }
    

}
