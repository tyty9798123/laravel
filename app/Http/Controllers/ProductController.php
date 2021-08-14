<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index(){
        $products = $this->getProducts();
        
        return view('product.index', [
            "products" => $products
        ]);
    }
    //
    function show($id, Request $req)
    {
        #$id = $req->input('id');
        $products = $this->getProducts();

        $index = $id - 1;
        if ($index >=0 && $index < count($products)) {
            // show page
            $product = $products[$index];
            var_dump($product);
    
            return view('product.show', [
                "product" => $product
            ]);
        }
        else{
            // 404 not found
            abort(404);
        }
    }
       /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'product_name' => 'required|string|max:6',
            'product_price' => 'required|integer|min:0|max:9999',
            'product_image' => ["required", "string", "regex:/^images\/\w+\.(png|jp?g)$/i"]
        ]);
        
        return redirect()->route('products.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $products = $this->getProducts();

        $index = $id - 1;
        if ($index >=0 && $index < count($products)) {
            // show page
            $product = $products[$index];
            return view('product.edit', [
                "product" => $product
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $method = $request->method();
        echo $method;

        $products = $this->getProducts();

        $index = $id - 1;
        if ($index >=0 && $index < count($products)) {
            // show page
            $product = $products[$index];
            return redirect()->route('products.edit', 
                ["product" => $product['id']]
            );
        }


        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        echo "deleted";
        return redirect()->route('products.index');
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