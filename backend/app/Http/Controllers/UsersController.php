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

    /**
     * Users - Login
     * 
     * User login
     * @group Users
     * @bodyParam email string required User email
     * @bodyParam password string required User password. No-example
     * @response { "success": true, "data": ... }
     */
    public function login(Request $request)
    {

        $validated = $this->apiValidate($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validated)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            $user->update(['last_login_at' => now()]);

            $user->makeHidden(['created_at', 'updated_at', 'email_verified_at']);

            return $this->apiResponse(['message' => __('common.success-login'), 'token' => $token, 'user' => $user], true, 200);
        }

        return $this->apiResponse(['errors' => ['auth' => __('common.invalid-credentials')]], false, 401);
    }

    /**
     * Users - Logout
     * 
     * User logout
     * @group Users
     * @header Authorization Bearer 34|QuEKf9WXXVEujNztucGY0ArHVoHBLRIOGNCVcItY9e5bc39b
     * @response { "success": true, "data": ... }
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->apiResponse(['message' => __('common.success-logout')], true, 200);
    }

    /**
     * Registration (Configuration)
     * 
     * All needed data, form details, field options for user registration form
     * @group Registration
     * @responseField data.translations Translations for user registration form
     * @responseField data.countries Countries country field options
     * @responseField data.reg_token Registration token needed for registration steps
     * @response { "success": true, "data": ... }
     */
    public function registrationConfig(Request $request)
    {
        $countries = \App\Models\Countries::all()->pluck('name', 'cca2');
        $token = 'reg-' . \Str::random(64);

        return $this->apiResponse(['translations' => __('user-registration'), 'countries' => $countries, 'reg_token' => $token], true, 200);
    }


    /**
     * Registration (Multi-Steps)
     * 
     * Actual registration process (Step 1-5)
     * @group Registration
     * @bodyParam step integer required The step of the registration process. Example: 2
     * @bodyParam email string required (Required in Step 1) User email
     * @responseField next_step Indicates the next step or the next form to be shown
     * @responseField token Registration token needed for registration steps
     * @response { "success": true, "data": { "next_step": ... , "token": ...} }
     */
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
                return $this->apiResponse(['errors' => ['message' => __('common.invalid-request')]], false, 422);
        }
    }

}
