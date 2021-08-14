<form method="post" action="{{ route('products.store') }}">
    @csrf
    <div>
        <label for="product_name">Product Name: </label>
        <input type="text" name="product_name" value="{{ old('product_name') }}">
    </div>
    <div>
        <label for="product_price">Product Price: </label>
        <input type="number" name="product_price" value="{{ old('product_price') }}">
    </div>
    <div>
        <label for="product_image">Product Image: </label>
        <input type="text" name="product_image" value="{{ old('product_image') }}">
    </div>
    <button type="submit">Submit</button>
</form>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif