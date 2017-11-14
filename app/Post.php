<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // protected $table ='tablename'
    protected $table ='posts';
	public $primaryKey = 'id';
	public $timestamps = true;

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function category(){
		return $this -> belongsTo('App\Category');
	}

	public function tags(){
		return $this -> belongsToMany('App\Tag');
	}
}
