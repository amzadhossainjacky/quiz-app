<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RouteHandlingController extends Controller
{
    //

    public function index(){

        $data = array('message' => 'page not found');
        return response()->json($data, 200);
    }
}
