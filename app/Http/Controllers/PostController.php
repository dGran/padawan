<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
	public function index()
	{
	    $posts = \App\Post::all();

	    return view('posts.index', compact('posts'));
	}

	public function destroy(Post $post)
	{
		dd($post);
		if (Post::findOrFail($post)->delete()) {
	    	flash()->success('The post was deleted!');
		} else {
			flash()->error('The post could not be deleted!');
		}
	    return redirect()->back();
	}
}
