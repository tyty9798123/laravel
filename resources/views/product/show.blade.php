@extends('layouts.app')

@section('content')
    <div>
        @foreach ($product->categoriesList() as $category)
            @if ( !$loop->first )
                <span>&nbsp;>>&nbsp;</span>
            @endif
            <a href="/products?category_id={{$category->id}}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
    <h1>{{ $product->name }}</h1>
    <img width="200" src="{{ $product->image_url }}">
    <div style="margin: 36px 0;">
        <p>Price ${{ $product->price }}</p>
        <input type="number" min="1" id="quantity" value="1" />
        <button type="button" id="addToCart">Add to cart</button>
    </div>

    
    <script>
        var productId = {{ $product->id }}
        initAddToCart(productId)
    </script>
@endsection