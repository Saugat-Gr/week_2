@extends('layouts.app')


@section('content')


<div class="container-sm vh-100 d-flex align-items-center">

 <div class="container-sm  border border-lg p-5 shadow-lg">
     
     <form action="{{ route('post.update', $post) }}" enctype="multipart/form-data" method="POST">
        @method('PUT')
     @csrf
       <h3 class="text-center">Edit Post</h3>
        
       <div class="mb-4">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" required class="form-control" value="{{ old('title', $post->title) }}">
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>


        <div class="mb-4">
            <label for="images[]" class="form-label">Images</label>
            <div id="preview"></div>
            <input type="file" class="form-label" name="images[]" multiple onchange="readURL(this)">
        
        @error('images')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        
        </div>

         <div class="mb-3">
            <label class="form-label">Category:</label>
            <select name="category_id" class="form-select">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        @if(old('category_id', $post->category_id ?? '') == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="mb-4">
            <label for="post_content" class="form-label">Post Description</label>
             <textarea name="post_content" id="editor" class="form-label">
                {{ old('post_content', $post->post_content) }}
             </textarea>
            
             @error('post_content')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        
            </div>

        <button type="submit" class="btn btn-dark  float-end">Create</button>

     </form>
   
  </div>

 </div>

 <script>
    const easyMDE = new EasyMDE({
        element: document.getElementById('editor'),
        spellChecker: true,
        status: false,
         maxHeight: "300px",
        toolbar: [
        "bold",
        "italic",
        "heading",
        "|",
        "quote",
        "unordered-list",
        "ordered-list",
        "|",
        "link",
        "preview",
        "side-by-side",
        "fullscreen"
    ]

    });

   function readURL(input) {

    const preview = document.getElementById('preview');
    preview.innerHTML = ""; // clear old previews

    if (input.files) {

        Array.from(input.files).forEach(file => {

            const reader = new FileReader();

            reader.onload = function (e) {

                const img = document.createElement("img");
                img.src = e.target.result;
                img.style.width = "200px";
                img.style.margin = "10px";

                preview.appendChild(img);
            };

            reader.readAsDataURL(file);
        });
    }
}


</script>


@endsection 