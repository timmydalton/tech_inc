<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categories;
use App\Models\ProductType;

class CategoriesController extends Controller
{
    public function get_all(Request $request) {
      $params = $request->all();
      $categories = Categories::where([
          ['is_deleted', '=', '0'],
      ])->get();
      $product_type = ProductType::where([
        ['is_deleted', '=', '0'],
      ])->get();
      $data = [];
      $data['categories'] = $categories;
      $data['product_type'] = $product_type;
      return response()->json(['message' => 'success', 'data' => $data], 200);
    }
}
