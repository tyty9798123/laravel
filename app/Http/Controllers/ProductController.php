<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\ProductImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\HasMany;


class ProductController extends Controller
{
    function index(Request $req){
        $category_id = $req->input('category_id');

        if (!empty($category_id)){
            $category = Category::find($category_id);
            $products = $category->allRelatedProducts();
        }
        else{
            $products = Product::all();
        }        
        return view('product.index', [
            "products" => $products
        ]);
    }
    //
    function show($id, Request $req)
    {
        #$id = $req->input('id');
        $product = Product::findOrFail($id);

        return view('product.show', [
            "product" => $product
        ]);
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
        $diskName = "public";
        $name = $request->file('product_image')->getClientOriginalName();
        $path = $request->file('product_image')->storeAs(
            'products',
            $name,
            $diskName
        );
        $url = Storage::disk($diskName)->url($path);
        $product = new Product();
        $product->name = $request->input('product_name');
        $product->price = $request->input('product_price');
        $product->image_url = $url;
        $product->save();
        // Product::create([
        //     'name' => $request->input('product_name'),ç
        //     'price' => $request->input('product_price'),
        //     'image_url' => $url
        // ]);
        return redirect()->route('products.index')->withErrors([$path]);

        // $path = $request->file('product_image')->storeAs(
        //     'products', "自定義名稱", "public"
        // );
        //$path = $request->file('product_image')->store('public');
        //
        /*
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:6',
            'product_price' => 'required|integer|min:0|max:9999',
            'product_image' => new ProductImage()
        ]);
        if ($validator->fails()) {
            return redirect('products/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        */
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
        $product = Product::where('id', $id)->first();

        if (is_null($product)){
            abort(404);
        }
        return view('product.edit', [
            "product" => $product
        ]);
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
        #先進行驗證前面兩個資料
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:6',
            'product_price' => 'required|integer|min:0|max:9999',
        ]);
        #若資料有誤，回傳給使用者
        if ($validator->fails())
        {
            return redirect()->route('products.edit', $id)->withErrors($validator->errors());
        }
        $saveData = [
            'name' => $request->input('product_name'),
            'price' => $request->input('product_price'),
            'brand_name' => $request->input('product_brand'),
            'category_name' => $request->input('product_category')
        ];
        var_dump($saveData);
        # 如果有上傳檔案，上傳後加入saveData陣列中
        if ( $request->has('product_image') ){
            $diskName = "public";
            $name = $request->file('product_image')->getClientOriginalName();
            $path = $request->file('product_image')->storeAs(
                'products',
                $name,
                $diskName
            );
            $url = Storage::disk($diskName)->url($path);
            $saveData["image_url"] = $url;
        }
        $product = Product::where('id', $id)->first();
        $product->update($saveData);
        return view('product.show', [
            "product" => $product
        ]);


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
        $product = Product::find($id);
        if (is_null($product)){
            return redirect()->route('products.index');
        }
        $product->delete();
        return redirect()->route('products.index');

    }
    private function getProducts() {
        return DB::table('products')->get();
    }
}
