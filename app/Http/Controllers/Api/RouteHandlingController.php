<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RouteHandlingController extends Controller
{
    //Create route handling controller for unauthorize user access
    public function index(){
        $data = array('message' => 'page not found');
        return response()->json($data, 200);
    }
}
