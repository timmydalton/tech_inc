<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductType;

class ProductTypeController extends Controller
{
    public function get_by_key(Request $request) {
        if (!isset($request->key)) return response()->json(['message' => 'missing params'], 500);
        $data = ProductType::where([
            ['key', '=', $request->key],
            ['is_deleted', '=', '0']
        ])->first();
        return response()->json(['message' => 'success', 'data' => $data], 200);
      }
}
