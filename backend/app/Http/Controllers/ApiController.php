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

    /**
     * Handle invalid API requests.
     * 
     * This method returns a JSON response indicating that the request
     * was invalid, along with an appropriate error message and status code.
     * @urlParam catchall string Catchall parameter is not used. No-example.
     * @group Common
     * @response { "success": false, "data": {...} }
     */
    public function invalidRequest()
    {
        return response()->json([ 'success' => false, 'data' => ['message' => __('common.invalid-request') . ' / ' . __('common.invalid-method')], ], 404);
    }
}
