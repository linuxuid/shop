@extends('layouts.app')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}"> 
    <link rel="stylesheet" href="{{ asset('/css/admin/create.css') }}">
@endsection

@section('content')
<main>
    <div class="content">
            <h2>Add new category</h2>
            <div class="session">
                @if (session()->has('success'))
                    <p>your category has been added</p>
                @endif
            </div>

            <div class="admin_create_links">
                <a href="{{ route('admin.show', ['id' => 1]) }}">EDIT</a>
            </div>

            <form class="admin" action="{{ route('admin.store') }}" method="POST">
                @csrf
                <label for="name">
                    Name:
                </label>
                <input name="name" id="name" placeholder="name" value="{{ old('name') }}">
            @error('name')
                <span class="control_errors">{{ $message }}</span>
            @enderror
                <label for="slug">
                    Slug:
                </label>
                <input name="slug" id="slug" placeholder="slug" value="{{ old('slug') }}">
            @error('slug')
                <span class="control_errors">{{ $message }}</span>
            @enderror
                <label for="category_id">
                    Categories:
                </label>
                <select name="category_id" id="category_id">
                @foreach (App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach  
                </select>

                <button>
                    SUBMIT
                </button>
            </form>
        </div>
</main>
@endsection