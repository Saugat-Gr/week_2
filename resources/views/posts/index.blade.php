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
      <th scope="col">Published Date</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>


  </tbody>
</table>
</div>



@endsection