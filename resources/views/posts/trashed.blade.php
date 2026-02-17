@extends('layouts.app')


@section('content')

<style>
  .user-img{
     border-radius: 50%;
  }
</style>

<div class="container mt-5">
<table class="table table-striped border">
  <thead class="text-center">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Thumbnail</th>
      <th scope="col">Title</th>
      <th scope="col">Author</th>
      <th scope="col">Category</th>
      <th scope="col">Created Date</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody class="text-center">


    @foreach ($posts as $key => $post)

    
    <tr >
      <td class="align-middle">{{ $key + 1}}</td>
      <td onclick="window.location='{{ route('post.show', $post) }}'" style="cursor:pointer;"><img src="{{ asset("storage/" . $post->images[0]) }}" alt="" width="100px"></td>
      <td class="align-middle">{{ $post->title }}</td>
      <td class="align-middle">{{ App\Models\User::findOrFail($post->user_id)->name }}</td>
      <td class="align-middle">{{ $post->category->name}}</td>
      <td class="align-middle">{{ $post->created_at->format('d M, Y') }}</td>
      <td class="align-middle ">

        
           <form action="{{ route('post.destroy', $post) }}"  method="POST">
            @csrf
            @method('DELETE')
             <button type="submit" class="btn btn-danger text-light" onclick="alert('Do You Want to delete this post?')"><i class="bi bi-trash-fill"></i></button>
        </form>

      </td>
    </tr>

    @endforeach

  </tbody>
</table>
</div>



@endsection