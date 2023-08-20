<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //it will also have a form to create a new category
        $categories=Category::all();
        return view('categories.index')->withCategories($categories);

    }

    /**
     * Show the form for creating a new resource.
     */
    //this function we comment deliberately because in this controller only
    //and store are required.
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Save a category and then redirect back to index.
        $this->validate($request,array(
           'name'=>'required|max:255'
        ));
        $category=new Category;
        $category->name=$request->name;
        $category->save();

        Session::flash('success','New Category has been created');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
