@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <h3 class="btn btn-success float-end"><a href="{{route('users.index')}}" class="text-decoration-none text-white">Home</a></h3>
  <h2 class="mt-5">
    Edit User
  </h2>
<form action="{{route('users.update', $user)}}" method="POST" enctype="multipart/form-data" class="border p-4 ">

    @method('PUT')

  @csrf
  
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="name" name="name" class="form-control" id="name" aria-describedby="name" value="{{old('name', $user->name)}}" required>
    @error('name')
        <span class="text-danger">{{$message}}</span>
    @enderror
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{ $user->email}}" disabled>
  </div>

  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="password">
    @error('password')
        <span class="text-danger">{{$message}}</span>
    @enderror
  </div>

   <div class="mb-3">
    <label for="password" class="form-label">Confirm Password</label>
    <input type="password" name="password_confirmation" class="form-control" id="password">
    @error('password')
        <span class="text-danger">{{$message}}</span>
    @enderror
  </div>

   <div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="file" name="image" id="image" requried>
    <div id="imagePreview"></div>
    @error('image')
        <span class="text-danger">{{$message}}</span>
    @enderror
  </div>

   <div class="mb-3">
      <label for="date_of_birth">Date Of Birth:</label>
    <input type="date" name="date_of_birth" id="date_of_birth"  value="{{ old('date_of_birth', $user->date_of_birth) }}">
    @error('date_of_birth')
        <span class="text-danger">{{$message}}</span>
    @enderror
    </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

<script>
  $(document).ready(function() {
  // Select the file input and add a change event listener
  $("#image").change(function() {
    readURL(this);
  });
});

function readURL(input) {
  // Check if a file is selected and the FileReader API is supported
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    // Define what happens once the file is successfully read
    reader.onload = function(e) {
      // Set the src attribute of the image tag to the data URL
      $('#imagePreview').attr('src', e.target.result).show();
    };

    // Read the file as a data URL (Base64 encoded string)
    reader.readAsDataURL(input.files[0]);
  }
}

</script>

@endsection