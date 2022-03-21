@extends('layouts.app')

@section('links')
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">  
    <link rel="stylesheet" href="{{ asset('/css/basket/index.css') }}">      
@show

@section('content')
<main>
    <div class="left">
        {{-- left sidebar --}}
    </div>
{{-- START PHP CODE --}}
    @php
        $products = App\Models\Product::all()
    @endphp
{{-- END PHP CODE --}}
    <div class="content">
        <h1>Your shopping cart</h1>
    @if (count($products))
        @php
            $basketCost = 0;
        @endphp

        <table>
            <tr>
                <th>№</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total price</th>
            </tr>
        @foreach ($products as $product)
            @php
                $price = $product->price;
                $quantity = $product->pivot->quantity;
                $cost = $price * $quantity;
                $basketcost += $cost;
            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ number_format($price, 2, '.', '') }}</td>
                                <td>
                                    <i></i>
                                    
                                    <i></i>
                                </td>
                                <td>{{ number_format($cost, 2, '.', '') }}</td>
                            </tr>
        @endforeach  
        <tr>
            <th colspan="4" class="text-right">Итого</th>
            <th>{{ number_format($basketCost, 2, '.', '') }}</th>
        </tr>
    </table>
@else
    <p>Ваша корзина пуста</p>
@endif  
    </div>
</main>
@endsection