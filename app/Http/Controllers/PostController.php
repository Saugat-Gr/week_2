<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(){
         $this->middleware("check.auth");
   }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {
            $validated_data = $request->validated();

            $imagePath = [];

            if($request->hasFile('images')){

               foreach($request->images as $key => $image){
                   $imagePath[$key] = $image->store('posts', 'public');
               }

            }

            /* 
               Two options:
               First Option: Conversion of table column type onto: json and setting casts as array
               Second Option: json_encode() and json_decode(), I have followed the longer approach here to know the under the hood action,

            */

            // dd($validated_data, $imagePath);


             $post = (Post::create([
                  'title'=> $validated_data['title'],
                  'post_content' => $validated_data['post_content'],
                  'images' => json_encode($imagePath),
                  'user_id' => Auth::user()->id
             ]));

             return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

        return view('posts.show')->with('post', $post);
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
