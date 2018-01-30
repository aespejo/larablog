<?php

namespace App\Http\Controllers;

use Session;
use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    private $upload_dir = 'uploads/posts/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        return view('admin.posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags       = Tag::all();
        if( $categories->count() == 0 || $tags->count() == 0) {
            Session::flash('info', 'You need to add categories and tags first before creating a new post');
            return redirect()->back();
        }

        return view('admin.posts.create')
                ->with('categories', $categories)
                ->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->save($request, 0);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();

        return view('admin.posts.edit')
                ->with('categories', $categories)
                ->with('tags', Tag::all())
                ->with('post', $post);
        
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
        return $this->save($request, $id);
    }

    private function save($request, $id = 0)
    {

        $rules = [
            'title'     => 'required|max:255',
            'content'   => 'required',
            'category'  => 'required',
            'tags'      => 'required'
        ];

        if($id <= 0) $rules['featured'] = 'required';
        
        $this->validate($request, $rules);

        if($id > 0) {
            $post               = Post::findOrFail($id);
            $oldFileName        = $post->featured;
            $route              = redirect()->back();
        } else {
            $post   = new Post;
            $route  = redirect()->route('post.create');
        }

        if($request->hasFile('featured') && $request->file('featured') != "")
        {
            $filename       = time().$request->file('featured')->getClientOriginalName(); // get filename
            $post->featured = $this->upload_dir.$filename;
        }

        $post->title        = $request->title;
        $post->content      = $request->content;
        $post->category_id  = $request->category;
        $post->slug         = str_slug($request->title);
        $post->user_id      = Auth::user()->id;
        $rs                 = $post->save();

        if($rs) {
            $post->tags()->sync($request->tags);
            if( isset($oldFileName) && isset($filename)) {
                // $post->delete_image();
                $oldFileName = explode("/", $oldFileName);  
                $oldFileName = $oldFileName[count($oldFileName)-1];
                $this->deletePostImage($oldFileName);
            } 

            if(isset($filename)) {
                $request->file('featured')->move($this->upload_dir, $filename);
            }
            Session::flash('success', 'Record successfully saved!');
        } else {
            Session::flash('error', 'An error occured while saving the data. Please refresh the page!');
        }

        return $route;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $post = Post::withTrashed()->where('id', $id)->get(); returns collection of data as array from db
        $post = Post::withTrashed()->where('id', $id)->first();
        if($post) {
            // $filename   = explode("/", $post->featured);
            // $filename   = $filename[count($filename)-1];
            $rs         = $post->forceDelete();
            if($rs) {
                // $this->deletePostImage($filename);
                $post->delete_image();
                Session::flash('success', 'Record successfully deleted!');
            } else {
                Session::flash('error', 'An error occured while deleting data. Please reload the page!');
            }
        }

        return redirect()->back();
    }

    public function trashed()
    {
        return view('admin.posts.trashed')->with('posts', Post::onlyTrashed()->get());
    }

    public function trash($id)
    {
        $post       = Post::findOrFail($id);
        $rs         = $post->delete();
        if($rs) {
            Session::flash('success', 'Record successfully trashed!');
        } else {
            Session::flash('error', 'An error occured while updating the data. Please reload the page!');
        }
        return redirect()->back();
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        if($post) {
            $rs = $post->restore();
            if($rs) {
                Session::flash('success', 'Record successfully restored!');
            } else {
                Session::flash('error', 'An error occured while restoring data. Please reload the page!');
            }
        }

        return redirect()->back();
    }

    private function deletePostImage($filename)
    {
        if(!is_null($filename) && !empty($filename) && $filename != "")
        {
            $file_path = $this->upload_dir . $filename;
            if( file_exists($file_path) ) unlink($file_path);
        }
    }
}
