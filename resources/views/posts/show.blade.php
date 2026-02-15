@extends('layouts.app')


@section('content')


<div class="container-sm mt-5">
 <div class="card">


   <div class="card-body">
    
   <div class="card-header">
       <h3 >{{ $post->title }}</h3>
      
    <div class="user-div d-flex align-items-center gap-4">
       <p class="text-secondary"> 
      <img class="rounded-circle" src="{{ asset("storage/" . App\Models\User::find($post->user_id)->image) }}" alt="" height="50px">  
      {{ App\Models\User::findOrFail($post->user_id)->name }}</p>
     <p class="text-secondary">{{ $post->created_at->format('D M,Y') }}</p>
    </div>
    
   </div>



      
       @foreach ($post->images as $image)
           <img src="{{ asset('storage/' . $image) }}" alt="" width="100%">
       @endforeach

     <p class="mt-5">{{ $post->post_content }}</p>

   </div>

  </div>
 </div>


@endsection