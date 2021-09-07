<form method="post" action="{{ route('products.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <h3>{{ $product->name }}</h3>
    <div>
        <label for="product_name">Product Name: </label>
        <input type="text" name="product_name" value="{{ old('product_name') ?? $product->name }}">
    </div>
    <div>
        <label for="product_price">Product Price: </label>
        <input type="number" name="product_price" value="{{ old('product_price') ?? $product->price }}">
    </div>
    <div>
        <label for="product_image">Product Image: </label>
        <input type="file" name="product_image">
    </div>
    <div>
        <label for="product_category">Product category: </label>
        <input type="text" name="product_category" value="{{ old('product_category') ?? $product->category->name }}">
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