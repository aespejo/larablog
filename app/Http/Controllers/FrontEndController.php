<?php

namespace App\Http\Controllers;

use App\Settings;
use App\Post;
use App\Category;
use App\Tag;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
    	$catDisplay = array();
    	$categories = Category::take(3)->get();

    	if($categories) {
    		foreach ($categories as $cat) {
    			array_push($catDisplay, [
    				'id' 	=> $cat->id,
    				'name' 	=> $cat->name,
    				'posts' => $cat->posts()->orderBy('created_at', 'desc')->orderBy('created_at', 'desc')->take(3)->get()
    			]);
    		}
    	}
    	
    	return view('index')
    		->with('settings', Settings::first())
    		->with('categories', Category::take(5)->get())
    		->with('first_post', Post::orderBy('created_at', 'desc')->first())
    		->with('previous_post', Post::orderBy('created_at', 'desc')->skip(1)->take(2)->get())
    		->with('catDisplay', $catDisplay);
    }

    public function single_post($slug)
    {
    	$post = Post::where('slug', $slug)->first();
    	$next_id = Post::where('id', '>', $post->id)->min('id');
    	$prev_id = Post::where('id', '<', $post->id)->max('id');

    	return view('post')	
    		->with('post', $post)
    		->with('settings', Settings::first())
    		->with('categories', Category::take(5)->get())
    		->with('next_post', Post::find($next_id))
    		->with('prev_post', Post::find($prev_id))
    		->with('tags', Tag::all());
    }

    public function category_page($id)
    {
    	$category = Category::findOrFail($id);
    	return view('category')
    		->with('count', 0)
    		->with('tags', Tag::all())
    		->with('category', $category)
    		->with('categories', Category::take(5)->get())
    		->with('settings', Settings::first());

    }

    public function tag_page($id)
    {
    	$tag = Tag::findOrFail($id);
    	return view('tags')
    		->with('count', 0)
    		->with('tag', $tag)
    		->with('tags', Tag::all())
    		->with('categories', Category::take(5)->get())
    		->with('settings', Settings::first());
    }

    public function search_page()
    {
    	$posts = Post::where('title', 'like', '%'.request('query').'%')->get();
    	return view('results')
    		->with('count', 0)
    		->with('posts', $posts)
    		->with('tags', Tag::all())
    		->with('categories', Category::take(5)->get())
    		->with('settings', Settings::first());
    }
}
