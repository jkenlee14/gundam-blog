<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\User;
Use App\Category;
Use App\Tag;
Use App\Post;
Use Auth;
Use Image;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $tags = Tag::all();
        $categories = Category::all();
        $userprof = User::find(Auth::user()->id);
        if (auth()->user()->accesslevel == 1) {
            $posts = Post::all();
        } else{
            $user_id = auth()->user()->id;
            $user = User::find($user_id);
            $posts = $user->posts;
        }
        return view('dashboard')->with('posts', $posts)->with('categories', $categories)->with('tags', $tags)->with('users', $users)->with('userprof', $userprof);
        
    }

    public function storeCategory(Request $request)
    {
        $this->validate($request, [
            'categoryname' => 'required'
        ]);

        $category = new Category;
        $category->name = $request->input('categoryname');
        $category->save();

        return redirect('/dashboard')->with('success', 'Category added!');
    }

    public function updateCategory(Request $request)
    {
         $this->validate($request, [
            'updatename' => 'required'
        ]);
        $category = Category::find($request->id);
        $category->name = $request->input('updatename');
        $category->save();

        return redirect('/dashboard')->with('success', 'Category updated!');
    }

    public function deleteCategory(Request $request)
    {
        $category = Category::find($request->id);
        $category->categoryposts()->delete();
        $category->delete();
        return redirect('/dashboard')->with('success', 'Category deleted!');
    }

    public function storeTag(Request $request)
    {
        $this->validate($request, [
            'tagname' => 'required'
        ]);
        $tag = new Tag;
        $tag->name = $request->tagname;
        $tag->save();
        return redirect('/dashboard')->with('success', 'Tag added!');
    }

    public function updateTag(Request $request)
    {
        $this->validate($request, [
            'updatetagname' => 'required'
        ]);
        $tag = Tag::find($request->id);
        $tag->name = $request->input('updatetagname');
        $tag->save();

        return redirect('/dashboard')->with('success', 'Tag updated!');
    }

    public function deleteTag(Request $request)
    {
        $tag = Tag::find($request->id);
        $tag->posts()->detach();
        $tag->delete();
        return redirect('/dashboard')->with('success', 'Tag deleted!');
    }

    public function indexUser()
    {
         return redirect('/')->with('error', 'Access denied');
    }

    public function updateUser(Request $request)
    {
        $user = User::find($request->id);
        $user->accesslevel = $request->level;
        $user->save();
        return redirect('/dashboard')->with('success', 'User access level changed!');
    }

    public function deleteUser(Request $request)
    {
        // dd($request);
        $user = User::find($request->id);
        $user->posts()->delete();
        $user->delete();

        return redirect('/dashboard')->with('success', 'User deleted!');
    }

    public function indexProfile()
    {
        return redirect('/dashboard')->with('error', 'Access denied');
    }

    public function updateProfile(Request $request)
    {

        $this->validate($request,[
            'bio' => 'required',
            'profpic' => 'image|nullable|max:1999',
            'socmedfb' => 'nullable',
            'socmedtwitter' => 'nullable',
            'socmedother' => 'nullable'
        ]);

        //Handle file upload
        if ($request->hasFile('profpic')) {
            //Get Filename with extension
            $fileNameWithExt = $request->file('profpic')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('profpic')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $image = $request->file('profpic');
            //Upload Image
            // $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
            $location = public_path('assets/images/profiles/' .$fileNameToStore);
            Image::make($image)->save($location);
            } else{
            $fileNameToStore = 'default.png';
        }
        $updateuser = User::find(Auth::user()->id);
        $updateuser->bio = $request->input('bio');
        $updateuser->socmedfb = $request->input('socmedfb');
        $updateuser->socmedtwitter = $request->input('socmedtwitter');
        $updateuser->socmedother = $request->input('socmedother');
        // if ($request->hasFile('profpic')) {
        //     if ($updateuser->profpicture!='default.png') {
        //     //Delete the image
        //         chmod(public_path('assets/images/profiles/' . $updateuser->profpicture), 0777);
        //         unlink(public_path('assets/images/profiles/' . $updateuser->profpicture));
        //     }
        if ($request->hasfile('profpic')) {
            $updateuser->profpicture = $fileNameToStore;
        }
         $updateuser->save();
         return redirect('/dashboard')->with('success', 'Profile Updated!');
    }

}
