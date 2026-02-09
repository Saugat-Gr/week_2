@extends('layouts.app')


@section('content')

<style>
  .user-img{
     border-radius: 50%;
  }
</style>

<div class="container mt-5">
  <a href="{{route('users.index')}}" class="btn btn-success float-end mb-2">Home</a>
<table class="table table-striped border">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Avatar</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Date Of Birth</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>

  @if ($trashed)
      
  <tbody>
    @foreach ($trashed as $user)
  

    <tr>
      <th scope="row">{{$user->id}}</th>
      <td>
        <img class="user-img" src="{{asset( 'storage/' . $user->image)}}" alt="{{$user->name}}" width="50px" height="50px">
      </td>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{ $user->date_of_birth}}</td>
      <td >
        <form action="{{route('users.hardDelete', $user->id)}}" class="mb-3 d-inline-block" method="POST">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-danger m-2 btn-del" onclick="return confirm('Are you sure you want to delete this user?')">DELETE</button>
        </form>
       <button class="btn btn-success"> <a href="{{route('users.show', $user)}}" class=" text-decoration-none text-white "> Restore </a></button>
       </td>
    </tr>
    @endforeach
  </tbody>
  @endif

</table>
</div>



@endsection