<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CubeController extends Controller
{
    public function index()
    {
        return view('aplication.index');
    }

    public function postConfig(Request $request)
    {
        return $request->all();
    }
}
