@extends('layouts.main')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin/products/index.css') }}">    
    <link rel="stylesheet" href="{{ asset('/css/admin/create.css') }}">  
@show

@section('content')
<main>
    <div class="content">
        <h2>CREATE A NEW PRODUCT</h2>
            <div class="session">
                @if (session()->has('success'))
                    <p>your product has been added</p>
                @endif
            </div>

            <div class="admin_create_links">
                <a href="{{ route('admin.product.edit', ['id' => 1]) }}">EDIT</a>
            </div>

        <form class="admin" action="{{ route('admin.product.store') }}" method="POST">
            @csrf
            <label for="slug">
                Slug:
            </label>
                <input type="text" name="slug" id="slug" placeholder="slug" value="{{ old('slug') }}">
        @error('slug')
            <span class="control_errors">{{ $message }}</span>
        @enderror
            <label for="title">
                Title:
            </label>
                <input type="text" name="title" placeholder="title" id="title" value="{{ old('title') }}">
        @error('title')
            <span class="control_errors">{{ $message }}</span>
        @enderror
            <label for="price">
                Price:
            </label>
                <input type="number" name="price" placeholder="price" id="price" value="{{ old('price') }}">
        @error('price')
            <span class="control_errors">{{ $message }}</span>
        @enderror
            <label for="body">
                Body:
            </label>
                <textarea type="text" name="body" placeholder="body" id="body" value="{{ old('body') }}">
                </textarea>
        @error('body')
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