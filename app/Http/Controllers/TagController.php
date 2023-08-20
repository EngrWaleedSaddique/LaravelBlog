<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Session;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags=Tag::all();
        return view('tags.index')->withTags($tags);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,array(
            "name"=>"required|max:255"
        ));
        $tag=new Tag;
        $tag->name=$request->name;
        $tag->save();
        Session::flash('success','New Tag was successfully created');
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $tag=Tag::find($id);
        return view('tags.show')->withTag($tag);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag=Tag::find($id);
        return view('tags.edit')->withTag($tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tag=Tag::find($id);

        $this->validate($request,['name'=>'required|max:255']);
        $tag->name=$request->name;
        $tag->save();

        Session::flash('success','Successfully saved your new tag');
        return redirect()->route('tags.show',$tag->id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag=Tag::find($id);
        if($tag->posts()->detach()!=null){

        $tag->posts()->detach();
        
        }

        $tag->delete();

        Session::flash('success','Tag was deleted successfully.');
        return redirect()->route('tags.index');
    }
}
