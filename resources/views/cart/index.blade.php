@extends('layouts.app')

@section('content')
    <form action="{{ route('cart.cookie.update') }}" method="POST">
        @csrf
        @method('PATCH')
        <table border="1">
            <tr>
                <th>
                    ProductId
                </th>
                <th>
                    Name
                </th>
                <th>
                    Price
                </th>
                <th>
                    Quantity
                </th>
                <th>
                    Delete
                </th>
            <tr>
            @foreach($cartItems as $cartItem)
                <tr>
                    <td>
                        {{ $cartItem["product"]["id"] }}
                    </td>
                    <td>
                        {{ $cartItem["product"]["name"] }}
                    </td>
                    <td>
                        {{ $cartItem["product"]["price"] }}
                    </td>
                    <td>
                        <input type="number" 
                        value="{{ $cartItem["quantity"] }}"
                        name="product_{{$cartItem["product"]["id"]}}"
                        >
                    </td>
                    <td>
                        <input type="button" value="Delete"
                            class="cartDeleteBtn"
                            data-id="{{ $cartItem["product"]["id"] }}"
                        >
                    </td>
                </tr>
            @endforeach
        </table>
        <input type="submit" value="Update">
    </form>

    <script>
        initCartDeleteButton("{{ route('cart.cookie.delete') }}")

    </script>
@endsection