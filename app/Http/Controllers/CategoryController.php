<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use App\Models\Category;
use App\Traits\ToastrTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
     use ToastrTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('user')->get();
        return view("categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("categories.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        $validated_data = $request->validated();

        $category = Category::create([
             "name"=> $validated_data["name"],
             "user_id" => auth()->user()->id,
        ]);
        
        return redirect()->route("category.index");

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
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditCategoryRequest $request, Category $category)
    {
    
        $validated_data = $request->validated();    

        $category->update($validated_data);

        $this->toastrSuccess('Category Updated Successfully.');

        return redirect()->route('category.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        if($category->posts()->count() > 0){
              $this->toastrError('Cannot Delete Category. Posts associated');
              return redirect()->route('category.index');
        }

        $category->delete();
        
         $this->toastrSuccess('Category Removed Successfully');
         return redirect()->route('category.index');
    }
}
