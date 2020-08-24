<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Post;

class PostController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth');
    }
   public function create()
   {
     return view('posts.create');
    }
    public function store()
    {
        $data = request()->validate([
            'caption' => ['required','string'],
            'image' => ['required','image']
        ]);

        $imagePath = request('image')->store('uploads','public');
        $image =Image::make(public_path("/storage/{$imagePath}"))->fit(250,250);
        $image->save();

        auth()->user()->posts()->create([
        'caption'=> $data ['caption'],
        'image'=> $imagePath
    ]);

    return redirect()->route ('profiles.show',['user'=>auth()->user()]);
    }
    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
    }
}
