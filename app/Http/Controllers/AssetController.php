<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    public function upload_asset(Request $request) {
        $param = $request->all();
        $avatar = $param['avatar'];
        $path = Storage::putFile('public/asset', new File($avatar));
        $filename = explode('/', $path);
        $last = end($filename);
        $finalpath = 'http://localhost:8000/storage/asset/'.$last;
        $asset = new Asset;
        $asset->path = $finalpath;
        $asset->save();
        if (isset($filename)) return response()->json(['message' => 'success', 'data' => $asset], 200);
        return response()->json(['message' => $request->all()], 500);
    }
}
