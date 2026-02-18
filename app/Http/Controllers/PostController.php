<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Traits\ToastrTrait;
use Auth;
use Exception;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ToastrTrait, SoftDeletes;

    public function __construct(){
         $this->middleware("check.auth");
   }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['category', 'user', 'tags'])->get();

        return view('posts.index')->with('posts', $posts);
    }

    public function getTrashedPosts(){

       $posts = Post::onlyTrashed()->get();


       return view('posts.trashed', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {

            $validated_data = $request->validated();

            $tags = [];

            if(!empty($validated_data['tags'])){
                 foreach($validated_data['tags'] as $tagName){
                      $tag = Tag::firstOrCreate([
                         'name' => strtolower(trim($tagName))
                      ]);
                      $tags[] = $tag->id;
                 }
            }


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
                  'images' => ($imagePath),
                  'category_id' => $validated_data['category_id'],
                  'user_id' => Auth::user()->id
             ]));

                  $post->tags()->sync($tags);


                 $this->toastrSuccess('Post Created Successfully');
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
    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function softDelete(Post $post){

       $post->delete();
       $this->toastrSuccess('Post Trashed Sucessfully.');

       return redirect()->route('post.index');
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $post = Post::onlyTrashed()->find($id);

        $post->forceDelete();

        $this->toastrSuccess('Post Deleted Successfully');

        return redirect()->route('post.index');
    }
}
