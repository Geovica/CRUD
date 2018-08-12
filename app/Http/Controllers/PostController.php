<?php

namespace App\Http\Controllers;

use Illuminate\support\Facades\Storage;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
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
        //
           /* $posts=Post::all(); */

           $posts=Post::orderBy('id','asc')->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('posts.create');

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
                'title' => 'required',
                'body' => 'required',
                'cover_image' => 'image|nullable|max:1999'
                

        ]);

        //handle file upload
        if($request->hasFile('cover_image')){
        //Get filname with the extension
        
        $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
        
        //Get jus the filename
        
        $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);
        
        //GGet just the ext
        $extension=$request->file('cover_image')->getClientOriginalExtension();

        //filename to Store
        $fileNameToStore=$filename.'_'.time().'.'.$extension;
        
        //upload Image  
        
        $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        
        }
        
        else {
            $fileNameToStore='noimage.jpg';
        
        }

            
            $posts=new Post;
            $posts->title=$request->input('title');
            $posts->body=$request->input('body');
            $posts->user_id=auth()->user()->id;
            $posts->cover_image=$fileNameToStore;
            $posts->save();

            return redirect('/posts')->with('success','Post Created!');

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

        $posts= Post::find($id);
return view('posts.show')->with('posts', $posts);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        
        
        $posts= Post::find($id);


        if(auth()->user()->id !== $posts->user_id)
        {
            return redirect('/posts')->with('error', 'Unauthorize User!');
        }
        return view('posts.edit')->with('posts', $posts);

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
        //

        
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
                

    ]);

  //handle file upload
  if($request->hasFile('cover_image')){
    //Get filname with the extension
    
    $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
    
    //Get jus the filename
    
    $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);
    
    //GGet just the ext
    $extension=$request->file('cover_image')->getClientOriginalExtension();

    //filename to Store
    $fileNameToStore=$filename.'_'.time().'.'.$extension;
    
    //upload Image  
    
    $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
    
    }
    
   


        $posts=Post::find($id);
        $posts->title=$request->input('title');
        $posts->body=$request->input('body');;
        if($request->hasFile('cover_image')){
        $posts->cover_image=$fileNameToStore;}

        $posts->save();

        return redirect('/posts')->with('success','Post Updated!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $posts=Post::find($id);

        if(auth()->user()->id !== $posts->user_id)
        {
            return redirect('/posts')->with('error', 'Unauthorize User!');
        }

        if ($posts->cover_image != 'noimage.jpg'){
            Storage::delete('public/cover_images/'.$posts->cover_image);
        }
        $posts->delete();
        return redirect('/posts')->with('success','Post Deleted!');

    }
}
