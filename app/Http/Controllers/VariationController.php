<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Variation;

class VariationController extends Controller
{
    public function create_variation(Request $request) {
        $param = $request->all();
        if (!isset($param['product_id'], $param['image'], $param['name'], $param['price'], $param['quantity'])) return response()->json(['message' => 'missing params'], 500);
        $variation = new Variation;
        $variation->product_id = $param['product_id'];
        $variation->image = $param['image'];
        $variation->name = $param['name'];
        $variation->price = $param['price'];
        $variation->quantity = $param['quantity'];
        $variation->save();
    }

    public function update_variation(Request $request) {
        $param = $request->all();
        if (!isset($param['product_id'], $param['image'], $param['name'], $param['price'], $param['quantity'], $param['id'])) return response()->json(['message' => 'missing params'], 500);
        $variation = Variation::where([
            ['id', '=', $request->id]
        ])->first();
        $variation->product_id = $param['product_id'];
        $variation->image = $param['image'];
        $variation->name = $param['name'];
        $variation->price = $param['price'];
        $variation->quantity = $param['quantity'];
        $variation->save();
    }

    public function get_by_product_id(Request $request) {
        $id = $request->id;
        if (!isset($id)) return response()->json(['message' => 'missing params'], 500);
        $variations = Variation::where([
            ['is_deleted', '=', '0'],
            ['product_id', '=', $id]
        ])->get();
        return response()->json(['message' => 'ok', 'data' => $variations], 200);
    }
}
