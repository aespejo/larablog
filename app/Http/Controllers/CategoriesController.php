<?php

namespace App\Http\Controllers;

use Session;
use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index')
            ->with('categories', Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|max:255'
        ]);

        $category = new Category;
        $category->name = $request->name;
        $rs = $category->save();

        if($rs) {
            Session::flash('success', 'Record successfully saved!');
        } else {
            Session::flash('error', 'An error occured while saving the data. Please refresh the page!');
        }

        return redirect()->route('category.create');
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
        $category = Category::findOrFail($id);
        return view('admin.categories.edit')->with('category', $category);
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
        $this->validate($request, [
            'name'     => 'required|max:255'
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $rs = $category->save();

        if($rs) {
            Session::flash('success', 'Record successfully updated!');
        } else {
            Session::flash('error', 'An error occured while updating the data. Please refresh the page!');
        }

        return redirect()->route('category.edit', ['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if($category) {
            foreach ($category->posts as $post) {
                $post->delete_image();
                $post->forceDelete(); // better to do mysql cascade delete
            }

            $rs = $category->delete();
            if($rs) {
                Session::flash('success', 'Record successfully deleted!');
            } else {
                Session::flash('error', 'An error occured while deleting the data. Please refresh the page!');
            }
        }
        return redirect()->route('category.index');
    }
}
