<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;


class PhotoController extends Controller
{
    public function displayImage($filename){
        $path = storage_public($filename);

        if (!File::exists($path)) {

            abort(404);

        }

        $file = File::get($path);

        $type = File::mimeType($path);


        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);


        return $response;
    }

    public function image($type, $filename) {
        $path = public_path() . '/images/'. $type . '/' . $filename;

        if (!File::exists($path)) {

            abort(404);
        }

        $file = File::get($path);

        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);


        return $response;
    }
}
