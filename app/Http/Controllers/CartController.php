<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function __construct()
    {
        //$this->middleware('check.token')->only('index');
    }
    //
    function index(Request $request){
        $cartItems = $this->getCartItems();
        return view('cart.index', [
            "cartItems" => $cartItems,
        ]);
    }

    public function updateCookie(Request $request) {
        $cart = $this->getCartFromCookie();
        foreach($cart as $productId => $quantity) {
            $key = "product_" . $productId;
            if ($request->has($key)){
                $cart[$productId] = $request->input($key);
            }
        }
        $cart = json_encode($cart, true); # array to json type string
        // Cookie::queue('cart', $cart);

        Cookie::queue(
            Cookie::make(
                'cart', $cart, 60*24*7, null, null, false, false
            )
        );
        return redirect()->route('cart.index');
    }
    public function deleteCookie(Request $request) {
        if ($request->has('id')) {
            $productId = $request->input('id');
            $cart = $this->getCartFromCookie();
            if (isset($cart[$productId])){
                unset($cart[$productId]);
                #怕被清空完後，會傳送[]給client端，導致出錯。
                $cartToJson = empty($cart) ? "{}" : json_encode($cart, true);
                Cookie::queue(
                    Cookie::make(
                        'cart', $cartToJson, 60*24*7, null, null, false, false
                    )
                );
                return response(route('cart.index'));
            }
        }
    }
    private function getCartFromCookie(){
        $cart = Cookie::get('cart');
        if (!is_null($cart)) {
            $cart = json_decode($cart, true); #true = to array
        }
        else{
            $cart = [];
        }
        return $cart;
    }

    private function getCartItems() {
        $cart = $this->getCartFromCookie();
        $productIds = array_keys($cart);
        $cartItems = array_map(function ($productId) use ($cart) {
            $quantity = $cart[$productId];
            $product = $this->getProduct($productId);
            if ($product) {
                return [
                    "product" => $product,
                    "id" => $productId,
                    "quantity" => $quantity
                ];
            }
            else{
                return null;
            }
        }, $productIds);
        return $cartItems;
        // $products = $this->getProducts();
    }

    private function getProduct($id){
        $products = $this->getProducts();
        foreach ($products as $product){
            if ($product["id"] == $id) {
                return $product;
            }
        }
        return null;
    }

    private function getProducts() {
        return [
            [
                "id" => 1,
                "name" => "Orange1",
                "price" => "250",
                "imageUrl" => asset('img/orange_01.jpeg')
            ],
            [
                "id" => 2,
                "name" => "Orange2",
                "price" => "330",
                "imageUrl" => asset('img/orange_02.jpeg')
            ]
        ];
    }

}
