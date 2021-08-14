<form method="post" action="{{ route('products.update', ['product' => $product['id']]) }}">
    @csrf
    @method('PATCH')
    <input type="text" name="title">
    <button type="submit">Submit</button>
</form>