<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Services\UserRegistrationService;
use App\Http\Traits\ApiResponseTrait;
use Password;

class UsersController extends Controller
{
    use ApiResponseTrait;

    /**
     * Users - Login
     * 
     * User login
     * @group Users
     * @subgroup Authentication
     * @bodyParam email string required User email address.
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
     * @subgroup Authentication
     * @header Authorization Bearer 34|QuEKf9WXXVEujNztucGY0ArHVoHBLRIOGNCVcItY9e5bc39b
     * @header Accept required application/json
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
     * @group Users
     * @subgroup Registration
     * @responseField data.translations Translations for user registration form
     * @responseField data.countries Countries country field options
     * @responseField data.reg_token Registration token needed for registration steps
     * @response { "success": true, "data": ... }
     */
    public function registrationConfig(Request $request)
    {
        $countries = \App\Models\Countries::all()->pluck('name', 'cca2');
        $token = 'reg-' . \Str::random(64);

        return $this->apiResponse(['translations' => __('user.registration'), 'countries' => $countries, 'reg_token' => $token], true, 200);
    }

    /**
     * Registration (Multi-Steps)
     * 
     * Actual registration process (Step 1-5)
     * @group Users
     * @subgroup Registration
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
            case '1': // Email
                return $registrationService->handleStep1($request);
            case '2': // Personal information
                return $registrationService->handleStep2($request);
            case '3': // Contact details
                return $registrationService->handleStep3($request);
            case '4': // Further details
                return $registrationService->handleStep4($request);
            case '5': // Almost there!
                return $registrationService->handleStep5($request);
            case '6': // Verification
                return $registrationService->handleStep6($request);
            case '7': // Password / Complete
                return $registrationService->handleStep7($request);
            default:
                return $this->apiResponse(['errors' => ['message' => __('common.invalid-request')]], false, 422);
        }
    }

    /**
     * Reset Password (Configuration)
     * 
     * All needed data, form details, field options for user reset password form
     * @group Users
     * @subgroup Reset Password
     * @responseField data.translations Translations for user registration form
     * @response { "success": true, "data": ... }
     */
    public function resetPasswordConfig(Request $request)
    {
        return $this->apiResponse(['translations' => __('user.reset-password')], true, 200);
    }

    /**
     * Reset Password (Email)
     * 
     * Submitting email for a reset password
     * @group Users
     * @subgroup Reset Password
     * @responseField message Reset password message
     * @responseField email User email address
     * @response { "success": true, "data": ... }
     */
    public function resetPasswordEmail(Request $request)
    {
        $validated = $this->apiValidate($request->all(), [
            'email' => 'required|email',
        ]);

        $returnToken = '';

        $status = Password::broker()->sendResetLink(['email' => $validated['email']],
            function ($user, $token) use (&$returnToken) {
                $returnToken = $token;
            }
        );

        if($status === Password::RESET_LINK_SENT) {
            // 'token' => $returnToken - just in case
            return $this->apiResponse(['message' => __($status), 'email' => $validated['email'],'token' => $returnToken], true, 200);
        }

        return $this->apiResponse(['errors' => __($status)], false, 400);
    }
    /**
     * Reset Password (Process)
     * 
     * Resetting password from token emailed to user
     * @group Users
     * @subgroup Reset Password
     * @responseField token Reset token from a link emailed to the user
     * @responseField email User email address
     * @responseField password New password minimum 8 characters
     * @responseField password_confirmation Password confirmation
     * @response { "success": true, "data": ... }
     */
    public function resetPasswordProcess(Request $request)
    {
        $validated = $this->apiValidate($request->all(), [
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string',
        ]);

        // Call the Password broker's reset method
        $status = Password::broker()->reset( $validated, function ($user, $password) {
                $user->forceFill(['password' => bcrypt($password)])->save();
                // Generate new remember token
                $user->setRememberToken(\Str::random(60));
                $user->save();
            }
        );

        if($status === Password::PASSWORD_RESET) {
            return $this->apiResponse(['message' => __($status), 'email' => $validated['email']], true, 200);
        }

        return $this->apiResponse(['errors' => __($status)], false, 400);
    }
}
