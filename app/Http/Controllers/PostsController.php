<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\User;
use App\Category;
use App\Tag;
use Image;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        // $users = User::all;
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response     */
    public function create()
    {
        $tag_list = Tag::pluck('name', 'id');
        $category_list = Category::pluck('name', 'id');
        return view('posts.create')->with('category_list', $category_list)->with('tag_list', $tag_list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999',
            'category_id' => 'required'
        ]);

        //Handle file upload
        if ($request->hasFile('cover_image')) {
            //Get Filename with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $image = $request->file('cover_image');
            //Upload Image
            // $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
            $location = public_path('assets/images/' .$fileNameToStore);
            Image::make($image)->text('Hyper Mega Gunpla 2017', 10, 10, function($font){
                $font->size(20);
            })->save($location);

        } else{
            $fileNameToStore = 'noimage.svg';
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category_id = $request->input('category_id');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();
        $post->tags()->sync($request->tags, false);

        return redirect('/posts')->with('success', 'Post created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category_list = Category::pluck('name', 'id');
        $tag_list = Tag::pluck('name', 'id');
        // $tag_selected = Tag::pluck('id');
        $tag_selected = Post::find($id)->tags;
        // dd($tag_selected);
        $post = Post::find($id);
        //Check for correct user
        if ((auth()->user()->id==$post->user_id) or (auth()->user()->accesslevel == 1)) {
            return view('posts.edit')->with('post', $post)->with('category_list', $category_list)->with('tag_list', $tag_list)->with('tag_selected', $tag_selected);
        } else{
            return redirect('posts')->with('error', 'You do not have permission to do this action!');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999',
            'category_id' => 'required'
        ]);

        if ($request->hasFile('cover_image')) {
            //Get Filename with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $image = $request->file('cover_image');
            //Upload Image
            // $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
            $location = public_path('assets/images/' .$fileNameToStore);
            Image::make($image)->text('Hyper Mega Gunpla 2017', 10, 10, function($font){
                $font->size(20);
            })->save($location);
        } 

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category_id = $request->input('category_id');
         if ($request->hasFile('cover_image')) {
            if ($post->cover_image!='noimage.svg') {
            //Delete the image
            // Storage::delete('public/cover_images/' .$post->cover_image);
                // unlink(public_path('assets/images/' . $post->cover_image));
            }
            $post->cover_image = $fileNameToStore;
         }
        $post->save();
        $post->tags()->sync($request->tags, true);

        return redirect('/posts')->with('success', 'Post Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();
        //Check for correct user
        if ((auth()->user()->id==$post->user_id) or (auth()->user()->accesslevel == 1)) {
            if ($post->cover_image!='noimage.svg') {
            //Delete the image
           unlink(public_path('assets/images/' . $post->cover_image));
             }
              $post->delete();
              return redirect('/posts')->with('success', 'Post Deleted!');
        } else{
            return redirect('posts')->with('error', 'You do not have permission to do this action!');
        }
       
    }
}
