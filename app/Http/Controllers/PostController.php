<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Session;
use App\Models\Category;
use App\Models\Tag;
use Image;
use Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //create a variable and store all the blog posts from database in variable.
        //below query return all the posts in inside the post table.
        //Session check condition here users if login or logout.

        $data=array();
        if(Session::has('loginId')){
            $data=User::where('id','=',Session::get('loginId'))->first();
            $posts=Post::orderBy('id','desc')->paginate(3);
            return view('posts.index')->withPosts($posts);
        }
        else
        {   
            return redirect('/');
        }

        //Session check validation here
        // $posts=Post::all();
        

        //below code is for pagination
        

        // return view('posts.index')->withPosts($posts);
        //return a view and pass it in the above variable

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        $tags=Tag::all();
        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     */
    //this function is called automatically when we specify the posts url in form.
    //because by default the post method is specified.
    
    public function store(Request $request)
    {
        //validation of data we use $this->validate for validation of data
        $this->validate($request,array(
            'title'=>'required|max:255',
            'slug'=>'required||alphadash|max:255|min:5',
            'category_id'=>'required|integer',
            'body'=>'required',
            'featured_image'=>'sometimes|image'
        ));

        //validation its ends here
        //stores data in the database.
        $post=new Post;
        $post->title=$request->title;
        $post->slug=$request->slug;
        $post->category_id=$request->category_id;
        $post->body=$request->body;

        //Save Image file code here

        if($request->hasFile('featured_image')){
            $image=$request->file('featured_image');
            $filename= time().'.'.$image->getClientOriginalExtension();
            $location=public_path('images/'.$filename);
            Image::make($image)->resize(800,400)->save($location);
            $post->image=$filename;
        }
        //save image file codes ends here



        $post->save();

        //this message is only for one http request. Session flash messages is used to 
        // show information messages.
        $post->tags()->sync($request->tags,false);

        Session::flash('success','The blog post was successfully saved.');

        return redirect()->route('posts.show',$post->id);


        //store data in the database codes ends here.

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //find is used to search the item by primary key only or you can say id only.\
        //below code show the individual code
        $post=Post::find($id);
        //
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //find the post in the database and save it in the variable.
        $post=Post::find($id);
        $categories=Category::all();
        $cats=array();
        foreach($categories as $category)
        {
            $cats[$category->id]=$category->name;
        }
        $tags=Tag::all();
        $tags2=array();
        foreach($tags as $tag){ 
            $tags2[$tag->id]=$tag->name;
        }
        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags2);

        //return the view pass in the variable we previously created.
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate the data
        $post=Post::find($id);
        if($request->input('slug') == $post->slug)
        {
            $this->validate($request,array(
                'title'=>'required|max:255',
                'category_id'=>'required|integer',
                'body'=>'required',
                'featured_image'=>'image'

            ));
        }
        else{
            $this->validate($request,array(
                'title'=>'required|max:255',
                'slug'=>'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'category_id'=>'required|integer',
                'body'=>'required',
                'featured_image'=>'image'
            ));
        }

        //Save the data to the database
        $post=Post::find($id);
        $post->title=$request->input('title');
        $post->slug=$request->input('slug');
        $post->category_id=$request->input('category_id');
        $post->body=$request->input('body');

        if($request->hasFile('featured_image')){
            //add the new photo
            $image=$request->file('featured_image');
            $filename= time().'.'.$image->getClientOriginalExtension();
            $location=public_path('images/'.$filename);
            Image::make($image)->resize(800,400)->save($location);
            $oldFilename=$post->image;
            //update the database
            $post->image=$filename;
            if($oldFilename!=null){
                Storage::delete($oldFilename);
            }
            

        }


        $post->save();

        
        //if we didn,t use the false in parameter then the below command will delete all the records from 
        //database.
        if(isset($request->tags)){
            $post->tags()->sync($request->tags);
        }
        else{
            $post->tags()->sync(array());
        }
        
        Session::flash('success','This post was successfully saved.');
        return redirect()->route('posts.show',$post->id);

        //redirect flash data to posts.show
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $post=Post::find($id);
        $post->delete();
        //below line is used to delete the reference inside tags table if its exist.
        $post->tags()->detach();
            
        Session::flash('success','The message was deleted successfully');
        return redirect()->route('posts.index');
    }
}
