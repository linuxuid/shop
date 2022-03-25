@extends('layouts.app')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">        
    <link rel="stylesheet" href="{{ asset('/css/admin/edit.css') }}">
@endsection

@section('content')
<main>
    <div class="left">
        <h2>Categories:</h2>
        @foreach (App\Models\Category::all() as $category)
            <p><a href="{{ route('admin.show', ['id' => $category->id]) }}">{{ $category->name }}</a></p>
        @endforeach
    </div>
    
    <div class="content">
        <h2>Edit category</h2>
        <div class="session">
            @if (session()->has('success'))
                <p>your category has been changed</p>
            @endif
        </div>
        <div class="admin_create_links">
            <a href="{{ route('admin.create') }}">CREATE</a>
        </div>
        <form class="admin" action="{{ route('admin.edit.store', ['id' => $categories->id]) }}" method="POST">
            @csrf
            <label for="name">
                Name:
            </label>
            <input name="name" id="name" placeholder="name" value="{{ $categories->name }}">
        @error('name')
            <span class="control_errors">{{ $message }}</span>
        @enderror
            <label for="slug">
                Slug:
            </label>
            <input name="slug" id="slug" placeholder="slug" value="{{ $categories->slug }}">
        @error('slug')
            <span class="control_errors">{{ $message }}</span>
        @enderror    
            <button>
                SUBMIT
            </button>
        </form>
    </div>
</main>    
@endsection