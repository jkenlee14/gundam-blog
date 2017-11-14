<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Tag;

class PagesController extends Controller
{
    public function index(){
    	$tags = Tag::all();
    	$carousels = Post::orderByRaw('RAND()')->take(3)->get();
    	$posts = Post::orderBy('created_at', 'desc')->paginate(6);
    	return view('pages.index')->with('posts', $posts)->with('carousels', $carousels)->with('tags', $tags);
    }

    public function about(){
    	return view('pages.aboutus');
    }
}
