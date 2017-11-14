<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Tag;
use Carbon\Carbon;

class PagesController extends Controller
{
    public function index(){
    	$archives = Post::archives();
    	$tags = Tag::all();
    	$carousels = Post::orderByRaw('RAND()')->take(3)->get();
    	$posts = Post::orderBy('created_at', 'desc')->paginate(6);
    	return view('pages.index')->with('posts', $posts)->with('carousels', $carousels)->with('tags', $tags)->with('archives', $archives);
    }

    public function about(){
    	return view('pages.aboutus');
    }

    public function archive(){
    	$posts = Post::latest();
    	$archives = Post::archives();

    	if($month = request('month'))
    	{
    		$posts->whereMonth('created_at', Carbon::parse($month)->month);
    	}
    	if($year = request('year'))
    	{
    		$posts->whereYear('created_at', $year);
    	}

    	$posts = $posts->paginate(10);

    	return view('pages.archive')->with('posts', $posts)->with('archives', $archives);
    }
}
