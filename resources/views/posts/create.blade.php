@extends('layouts.app')


@section('content')


 <div class="container-sm mt-4 border border-lg p-4">
     
     <form action="#">
       <h3 class="text-center">Create A Post</h3>
        
       <div class="mb-4">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" required class="form-control">
        </div>


        <div class="mb-4">
            <label for="images[]" class="form-label">Images</label>
            <input type="file" name="images[]" id="images" required class="form-control">
        </div>

        <div class="mb-4">
            <label for="post_description" class="form-label">About Post</label>
             <textarea name="post_description" id="post_description" class="form-label"></textarea>
        </div>

         <div class="mb-3">
            
         </div>

     </form>
   
 </div>

@endsection 