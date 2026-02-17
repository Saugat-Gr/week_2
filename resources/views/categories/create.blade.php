@extends('layouts.app')


@section('content')


<div class="vh-100">

    
<div class="container h-75 d-flex align-items-center justify-content-center ">
    <form action="{{ route('category.store') }}" class="mb-4 border rounded p-5 shadow shadow-lg" style="width: 600px" method="POST">
        @csrf
        
        <h2 class="text-center mb-5">Create Category</h2>
        
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" name="name" id="name" class="form-control">

            @error('name')
                  <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button class="float-end btn btn-dark" type="submit">Create</button>

    </form>
</div>

</div>

@endsection