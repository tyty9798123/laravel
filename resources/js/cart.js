function initCart () {
    return getCart()
}
function getCart() {
    var cart = Cookies.get('cart')
    if (!cart){
        cart = {}
    }
    else{
        cart = JSON.parse(cart)
    }
    return cart
}
function saveCart(cart){
    Cookies.set('cart', JSON.stringify(cart));
}
function addProductToCart(productId, quantity) {
    var cart = getCart()
    var CurrentQuantity = parseInt( cart[productId] ) || 0;
    var addQuantity = parseInt( quantity ) || 0;
    var newQuantity = CurrentQuantity + addQuantity;
    updateProductToCart(productId, newQuantity)
}
function alertProductQuantity(productId){
    var cart = getCart()
    var quantity = parseInt( cart[productId] ) || 0;
    alert(`${productId}: ${quantity}`)
}
function initAddToCart(productId){
    var addToCartBtn = document.getElementById('addToCart');
    var quantityInput = document.getElementById('quantity');

    addToCartBtn.addEventListener('click', function(){
        addProductToCart(productId, quantityInput.value)
        alertProductQuantity(productId)
    })
}
function updateProductToCart(productId, newQuantity){
    var cart = getCart()
    cart[productId] = newQuantity;
    saveCart(cart)
}
function initCartDeleteButton(actionUrl) {
    var cartDeleteBtns = document.querySelectorAll('.cartDeleteBtn');
    for(var i = 0; i < cartDeleteBtns.length; i++){
        var cartDeleteBtn = cartDeleteBtns[i];
        cartDeleteBtn.addEventListener('click', function(e){
            
            var btn = e.target;
            var dataId = btn.getAttribute('data-id');
            
            var formData = new FormData();
            formData.append("id", dataId);
            formData.append("_method", "DELETE");

            var csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            var csrfToken = csrfTokenMeta.content;
            formData.append("_token", csrfToken);
            var request = new XMLHttpRequest();
            request.open("POST", actionUrl);
            request.onreadystatechange = function(){
                if (
                request.readyState === XMLHttpRequest.DONE
                && request.status === 200){
                    console.log(request.responseText)
                    window.location.replace(request.responseText)
                }
            }
            request.send(formData);
        })
    }
}