@extends('layouts.app')


@section('content')

<style>
  .user-img{
     border-radius: 50%;
  }
</style>

<div class="container mt-5">
  <a href="{{ route('post.create') }}" class="btn btn-success float-end mb-2">Create A Post</a>
<table class="table table-striped border">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Thumbnail</th>
      <th scope="col">Title</th>
      <th scope="col">Author</th>
      <th scope="col">Created Date</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>


    @foreach ($posts as $key => $post)
    
    <tr  >
      <td>{{ $key + 1}}</td>
      <td onclick="window.location='{{ route('post.show', $post) }}'" style="cursor:pointer;"><img src="{{ "storage/" . $post->images[0] }}" alt="" width="100px"></td>
      <td>{{ $post->title }}</td>
      <td>{{ App\Models\User::findOrFail($post->user_id)->name }}</td>
      <td>{{ $post->created_at->format('d M, Y') }}</td>
      <td>

        <button class="btn btn-primary"> <a href="#" class="text-decoration-none text-light">Edit</a> </button>
        <button class="btn btn-danger"> <a href="#" class="text-decoration-none text-light"> Delete </a></button>

      </td>
    </tr>

    @endforeach

  </tbody>
</table>
</div>



@endsection