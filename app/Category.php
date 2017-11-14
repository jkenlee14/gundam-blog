<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public function categoryposts(){
    	return $this->hasMany('App\Post');
    }

    public static function categorylist(){
    	return Category::all();
    }
}
