@extends('layouts.app')

@section('content')

<div class="container-sm mt-5 vh-100">
    <div class="card shadow-sm p-3 h-50">
        <div class="d-flex flex-row align-items-center justify-content-between gap-4">
            
            <!-- Left Side: Post Info -->
            <div class="flex-grow-1">
                <h3>{{ $post->title }}</h3>

                <div class="d-flex align-items-center gap-3 mb-2">
                    <img class="rounded-circle" 
                         src="{{ asset('storage/' . App\Models\User::find($post->user_id)->image) }}" 
                         alt="User" height="50" width="50">
                    <div>
                        <p class="mb-0">{{ App\Models\User::findOrFail($post->user_id)->name }}</p>
                        <small class="text-secondary">{{ $post->created_at->format('D M, Y') }}</small>
                    </div>
                </div>

                <p class="mt-5">{!! $post->html_description !!}</p>
            </div>

            <!-- Right Side: Post Images -->
            <div class="d-flex flex-column gap-2">
                @if (is_array($post->images) && count($post->images) > 0)
                    @foreach ($post->images as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="Post Image" 
                             class="rounded border" style="max-width: 200px; object-fit: cover;">
                    @endforeach
                @endif
            </div>

        </div>
    </div>
</div>

@endsection
