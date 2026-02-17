@extends('layouts.app')


@section('content')

<div class="container-sm mt-5">

     <button class="btn btn-success float-end">
        <a href="{{ route('category.create') }}" class="text-decoration-none text-light">
            Create
         <i class="bi bi-plus-square-fill"></i>
        </a>
     </button>

        <table class="table table-striped">
        
        <thead>
            <tr>
                <th>#</th>
                <th>Category Name</th>
                <th>Created By</th>
                <th>Actions</th>
            </tr>
        </thead>


        <tbody class="text-body-tertiary">
            @foreach ($categories as $key => $category)
            <tr class="">
                        
                    <td class="align-middle">{{ $key  + 1}}</td>
                    <td class="align-middle">{{ $category->name }}</td>
                    <td class="align-middle">{{ $category->user->name }}</td>
                    <td class="text-body-tertiary align-middle">
                        <button class="btn btn-primary"><a href="{{ route('category.edit', $category) }}" class="text-decoration-none text-light"><i class="bi bi-pencil-square"></i></a></button>

                        <form action="{{  route('category.destroy', $category) }}" method="POST">
                         @method('DELETE')
                        @csrf
                        <button class="btn btn-danger" type="submit"><i class="bi bi-trash-fill"></i></button>
                        </form>
                    </td>
                
            </tr>
                @endforeach
        </tbody>

        </table>
</div>
@endsection