<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Services\UserRegistrationService;
use App\Http\Traits\ApiResponseTrait;

class UsersController extends Controller
{
    use ApiResponseTrait;

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }

    public function registrationConfig(Request $request)
    {
        $countries = \App\Models\Countries::all()->pluck('name', 'id');
        $token = 'reg-' . \Str::random(64);

        return response()->json(['translations' => __('user-registration'), 'countries' => $countries, 'registration_token' => $token]);
    }

    public function register(Request $request)
    {
        $registrationService = new UserRegistrationService();

        $step = $request->input('step', '1');

        switch ($step) {
            case '1':
                return $registrationService->handleStep1($request);
            case '2':
                return $registrationService->handleStep2($request);
            case '3':
                return $registrationService->handleStep3($request);
            case '4':
                return $registrationService->handleStep4($request);
            case '5':
                return $registrationService->handleStep5($request);
            default:
                return $this->apiResponse(['errors' => ['token' => __('common.invalid-request')]], false, 422);
        }
    }

}
