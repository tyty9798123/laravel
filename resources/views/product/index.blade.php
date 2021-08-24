@extends('layouts.app')

@section('content')
    <h1>Products</h1>
    <a href="{{ route('products.create') }}">Create</a>
    <br>
    @foreach ($products as $product)
        <a href="{{route('products.show', ['product' => $product['id']] )}}">
            <img width="200" src="{{ $product['imageUrl'] }}">
        </a>
        <br>
        <a href="{{route('products.edit', ['product' => $product['id']] )}}">
            Edit
        </a>
        <br>
        <form method="post" action="{{ route('products.destroy', ['product' => $product['id']] ) }}">
            @csrf
            @method('delete')
            <input type="text" name="title">
            <button type="submit">Delete</button>
        </form>
        <hr>
    @endforeach

    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
@endsection