@extends('layouts.main')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/basket/index.css') }}">      
@show

@section('content')
<main>
<div class="content">
    <h1>Your shopping card</h1>
    @if (count($products))
        @php
            $basketCost = 0;
        @endphp
        <table class="table_basket">
            <tr>
                <th>№</th>
                <th>Name</th>
                <th>Price</th>
                <th>quantity</th>
                <th>total cost</th>
                <th>change quantity</th>
                <th>delete</th>
            </tr>
            @foreach($products as $product)
                @php
                    $itemPrice = $product->price;
                    $itemQuantity =  $product->pivot->quantity;
                    $itemCost = $itemPrice * $itemQuantity;
                    $basketCost = $basketCost + $itemCost;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <span>{{ $product->slug }}</span>
                    </td>
                    <td>{{ number_format($itemPrice, 2, '.', '') }}$</td>
                    <td>
                        <i></i>
                        <span>{{ $itemQuantity }}</span>
                        <i></i>
                    </td>
                    <td>{{ number_format($itemCost, 2, '.', '') }}$</td>
                    {{-- START FORM QUANTITY--}}
                    <td>
                        <form action="{{ route('basket.minus', ['id' => $product->id]) }}" method="POST">
                            @csrf
                        <button class="minus_btn"> 
                            -
                        </button>     
                        </form>

                        <form action="{{ route('basket.plus', ['id' => $product->id]) }}" method="POST">
                            @csrf
                        <button class="plus_btn">
                            +
                        </button>
                        </form>
                    </td>
                    {{-- END FORM QUANTITY--}}
                    <td>
                        <form action="{{ route('basket.remove', ['id' =>$product->id]) }}" method="POST">
                            @csrf
                        <button class="remove_btn">
                            &#8855;
                        </button>    
                    </td>
                </tr>
            @endforeach
            <tr>
                <th>Total</th>
                <th>{{ number_format($basketCost, 2, '.', '') }}$</th>
            </tr>
        </table>
    @else
        <p>Your shopping cart is empty</p>
        <div class="make_order">
            <a href="/basket/checkout">Make an order</a>
        </div>
    @endif
    </div>
</main>
@endsection