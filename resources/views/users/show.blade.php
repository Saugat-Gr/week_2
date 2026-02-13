@extends('layouts.app')

@section('content')


<div class="container border border-2 mt-2 shadow p-4">
     <a class="btn btn-success" href="{{route('users.index')}}">Home</a>
     <form action="{{route('users.destroy', $user)}}" class="mb-3 d-inline-block float-end" method="POST">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-danger m-2 btn-del" onclick="return confirm('Are you sure you want to delete this user?')">DELETE</button>
        </form>
     
     <div class="container-sm border shadow-lg p-4 mt-4 ">
    
          <h2 class="text-center mb-4 mt-4">About User</h2>
          
          <img src="{{asset('storage/' .$user->image)}}" alt="{{$user->name}}" height="250px">
          
          <div class="content mt-5">
      <p class=""> <strong> Name:</strong> {{$user->name}}</p>
      <p class=""> <strong>Email:</strong> {{$user->email}}</p>
      <p class=""> <strong> Date of Birth:</strong> {{$user->date_of_birth}}</p>
     
      </div>

     

</div>

 </div>

@endsection