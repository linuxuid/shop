@extends('layouts.app')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">  
    <link rel="stylesheet" href="{{ asset('/css/admin/products/index.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin/products/edit.css') }}">    
    <link rel="stylesheet" href="{{ asset('/css/admin/create.css') }}">  
@show

@section('content')
<main>
    <div class="left">
        <h2>Products:</h2>
        @foreach (App\Models\Product::all() as $products)
            <p><a href="{{ route('admin.product.edit', ['id' => $products->id]) }}">{{ $products->slug }}</a></p>
        @endforeach
    </div>


    <div class="content">
        <h2>
            EDIT YOUR PRODUCT
        </h2>
            <div class="session">
                @if (session()->has('success'))
                    <p>your product has been changed</p>
                @endif
            </div>

            <div class="admin_create_links">
                <a href="{{ route('admin.product.create') }}">CREATE</a>
            </div>

                <form class="admin" action="{{ route('admin.product.edit.store', ['id' => $products->id]) }}" method="POST">
                    @csrf
                    <label for="slug">
                        Slug:
                    </label>
                        <input type="text" name="slug" id="slug" placeholder="slug" value="{{ $products->slug }}">
                @error('slug')
                    <span class="control_errors">{{ $message }}</span>
                @enderror
                    <label for="title">
                        Title:
                    </label>
                        <input type="text" name="title" placeholder="title" id="title" value="{{ $products->title }}">
                @error('title')
                    <span class="control_errors">{{ $message }}</span>
                @enderror    
                    <label for="price">
                        Price:
                    </label>
                        <input type="number" name="price" placeholder="price" id="price" value="{{ $products->price }}">              
                @error('price')
                    <span class="control_errors">{{ $message }}</span>
                @enderror        
                    <label for="body">
                        Body:
                    </label>
                        <input class="body" type="text" name="body" placeholder="body" id="body" value="{{ $products->body }}">
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