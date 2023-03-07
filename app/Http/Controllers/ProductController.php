<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Products;

class ProductController extends Controller
{
    public function create_product(Request $request) {
        $params = $request->all();
        if (!(isset($request->name) && isset($request->key) && isset($request->info) && isset($request->categoriesId) && isset($request->productTypeId))) return response()->json(['message' => 'missing params'], 500);
        $product = new Products;
        $product->name = $request->name;
        $product->key = $request->key;
        $product->info = $request->info;
        $product->categories_id = $request->categoriesId;
        $product->product_type_id = $request->productTypeId;
        $product->display_price = $request->price;
        $product->display_image = $request->display_image;
        $product->save();
        return response()->json(['message' => 'ok', 'data' => $product], 200);
    }

    public function update_product(Request $request) {
        $params = $request->all();
        if (!(isset($request->id) && isset($request->name) && isset($request->key) && isset($request->info) && isset($request->categoriesId) && isset($request->productTypeId))) return response()->json(['message' => 'missing params'], 500);
        $product = Products::where([
            ['id', '=', $request->id]
        ])->first();
        $product->name = $request->name;
        $product->key = $request->key;
        $product->info = $request->info;
        $product->categories_id = $request->categoriesId;
        $product->product_type_id = $request->productTypeId;
        $product->display_price = $request->price;
        $product->display_image = $request->display_image;
        $product->save();
        return response()->json(['message' => 'ok', 'data' => $product], 200);
    }

    public function delete_product(Request $request) {
        $params = $request->all();
        if (!isset($request->id)) return response()->json(['message' => 'missing params'], 500);
        $product = Products::where([
            ['id', '=', $request->id]
        ])->first();
        $product->is_deleted = 1;
        $product->save();
        return response()->json(['message' => 'ok'], 200);
    }

    public function index(Request $request) {
        $products = Products::where([
            ['is_deleted', '=', '0']
        ])->orderBy('updated_at', 'DESC')->get();
        return response()->json(['message' => 'ok', 'data' => $products], 200);
    }

    public function get_by_id(Request $request) {
        $id = $request->id;
        if (!isset($id)) return response()->json(['message' => 'missing params'], 500);
        $product = Products::where([
            ['is_deleted', '=', '0'],
            ['id', '=', $id]
        ])->first();
        return response()->json(['message' => 'ok', 'data' => $product], 200);
    }
}
