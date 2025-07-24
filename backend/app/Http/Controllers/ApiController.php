<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Display a welcome message for the API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json([
            'title' => 'Weltsparen API!',
            'version' => '1.0.0',
            'description' => env('APP_NAME'),
        ]);
    }
}
