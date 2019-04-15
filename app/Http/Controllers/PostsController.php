<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\User;
use DB;

class PostsController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        // return Post::where('title', 'Post Two')->get();
        // $posts = DB::select('SELECT * FROM POSTS');
        // $posts = Post::orderBy('title', 'desc')->take(1)->get();
        // $posts = Post::orderBy('title', 'desc')->paginate(1);

        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'title' => 'required|max:255',
            'body' => 'required|max:10000',
            'cover_image' => 'image|nullable|max:1999'
        ]);
       
        //Handal File Upload
        if($request->hasFile('cover_image')){
            //Get file name with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Upload image
            $path =$request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            // return $filename;
        } else {
            $fileNameToStore = 'deafult-image.jpg';
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->cover_image = $fileNameToStore;
        $post->user_id = auth()->user()->id;
        $post->save();
        
        return redirect('/posts')->with('success', 'Post succesfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post= Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized permission!');
        }

        return view('posts.edit')->with('post', $post);
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
            'title' => 'required|max:255',
            'body' => 'required|max:10000',
            'cover_image' => 'image|nullable|max:1999'
        ]);
       
        //Handal File Upload
        if($request->hasFile('cover_image')){
            //Get file name with extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Upload image
            $path =$request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            // return $filename;
        } 

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
        
        return redirect('/posts')->with('success', 'Post successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized permission!');
        }

        if($post->cover_image != 'deafult-image.jpg'){
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();

        return redirect('/posts')->with('success', 'Post successfully deleted.');
    }
}
