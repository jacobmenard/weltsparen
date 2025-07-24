<?php

namespace App\Services;

use App\Models\UsersRegistrations;
use Illuminate\Support\Str;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Validation\Rules\Enum;
use App\Models\User;
use App\Models\UsersDetails;

class UserRegistrationService
{
    use ApiResponseTrait;

    /**
     * Handle the first step of user registration.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleStep1($request)
    {
        $validated = $this->apiValidate($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'newsletter' => 'sometimes|numeric',
        ]);

        $token = 'reg-' . Str::random(64);

        UsersRegistrations::create([
            'token' => $token,
            'data' => json_encode(['step_1' => ['email' => $validated['email']]]),
            'step' => 1,
            'expires_at' => now()->addMinutes(60),
        ]);

        return $this->apiResponse(['next_step' => 2, 'token' => $token]);
    }

    /**
     * Handle the second step of user registration.
     * Personal information
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleStep2($request)
    {
        $validated = $this->apiValidate($request->all(), [
            'reg_token' => 'required|exists:users_registrations,token',
            'salutation' => ['required', new Enum(\App\Enums\UserSalutationEnums::class)],
            'title' => ['required', new Enum(\App\Enums\UserTitleEnums::class)],
            'firstname' => 'required|string',
            'surname' => 'required|string',
            'birthday' => 'required|date',
        ]);

        // validate registration token
        $regToken = UsersRegistrations::regToken($request->input('reg_token'))->first();
        if (!$regToken || $regToken->expires_at < now()) {
            return $this->apiResponse(['errors' => ['token' => __('common.expired', ['field' => 'token'])]], false, 422);
        }
        // check previous step
        $data = json_decode($regToken->data, true);
        if (!isset($data['step_1'])) {
            return $this->apiResponse(['errors' => ['token' => __('common.missing-steps')]], false, 422);
        }

        // update registration token
        $data['step_2'] = [
            'salutation' => $validated['salutation'],
            'title' => $validated['title'],
            'firstname' => $validated['firstname'],
            'surname' => $validated['surname'],
            'birthday' => $validated['birthday'],
        ];

        $regToken->update([
            'step' => 2,
            'data' => json_encode($data),
        ]);

        return $this->apiResponse(['next_step' => 3, 'token' => $regToken->token]);
    }

    /**
     * Handle the third step of user registration.
     * Contact details
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleStep3($request)
    {
        $validated = $this->apiValidate($request->all(), [
            'reg_token' => 'required|exists:users_registrations,token',
            'street' => 'required|string',
            'house_no' => 'required|string',
            'zip' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|exists:countries,cca2',
        ]);

        // validate registration token
        $regToken = UsersRegistrations::regToken($request->input('reg_token'))->first();
        if (!$regToken || $regToken->expires_at < now()) {
            return $this->apiResponse(['errors' => ['token' => __('common.expired', ['field' => 'token'])]], false, 422);
        }
        // check previous step
        $data = json_decode($regToken->data, true);
        if (!(isset($data['step_1']) && isset($data['step_2']))) {
            return $this->apiResponse(['errors' => ['token' => __('common.missing-steps')]], false, 422);
        }

        // update registration token
        $data = json_decode($regToken->data, true);
        $data['step_3'] = [
            'street' => $validated['street'],
            'house_no' => $validated['house_no'],
            'zip' => $validated['zip'],
            'city' => $validated['city'],
            'country' => $validated['country'],
        ];

        $regToken->update([
            'step' => 3,
            'data' => json_encode($data),
        ]);

        return $this->apiResponse(['next_step' => 4, 'token' => $regToken->token]);
    }

    /**
     * Handle the fourth step of user registration.
     * Further details
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleStep4($request)
    {
        $validated = $this->apiValidate($request->all(), [
            'reg_token' => 'required|exists:users_registrations,token',
            'marital_status' => ['required', new Enum(\App\Enums\UserMaritalStatusEnums::class)],
            'profession' => ['required', new Enum(\App\Enums\UserProfessionEnums::class)],
            'place_of_birth' => 'required|string',
            'country_of_birth' => 'required|string',
            'nationality' => 'required|string',
            'second_nationality' => 'sometimes|string',
            'country_tax_residence' => 'required|string',
            'country_us_tax' => 'sometimes|numeric',
        ]);

        // validate registration token
        $regToken = UsersRegistrations::regToken($request->input('reg_token'))->first();
        if (!$regToken || $regToken->expires_at < now()) {
            return $this->apiResponse(['errors' => ['token' => __('common.expired', ['field' => 'token'])]], false, 422);
        }
        // check previous step
        $data = json_decode($regToken->data, true);
        if (!(isset($data['step_1']) && isset($data['step_2']) && isset($data['step_3']))) {
            return $this->apiResponse(['errors' => ['token' => __('common.missing-steps')]], false, 422);
        }

        // update registration token
        $data = json_decode($regToken->data, true);
        $data['step_4'] = [
            'marital_status' => $validated['marital_status'],
            'profession' => $validated['profession'],
            'place_of_birth' => $validated['place_of_birth'],
            'country_of_birth' => $validated['country_of_birth'],
            'nationality' => $validated['nationality'],
            'second_nationality' => $validated['second_nationality'] ?? '',
            'country_tax_residence' => $validated['country_tax_residence'],
            'country_us_tax' => $validated['country_us_tax'] ?? 0,
        ];

        $regToken->update([
            'step' => 4,
            'data' => json_encode($data),
        ]);

        return $this->apiResponse(['next_step' => 5, 'token' => $regToken->token]);
    }

    /**
     * Handle the fifth step of user registration.
     * Almost there!
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleStep5($request)
    {
        $validated = $this->apiValidate($request->all(), [
            'reg_token' => 'required|exists:users_registrations,token',
            'mobile_number' => 'required|string',
        ]);

        // validate registration token
        $regToken = UsersRegistrations::regToken($request->input('reg_token'))->first();
        if (!$regToken || $regToken->expires_at < now()) {
            return $this->apiResponse(['errors' => ['token' => __('common.expired', ['field' => 'token'])]], false, 422);
        }
        // check previous step
        $data = json_decode($regToken->data, true);
        if (!(isset($data['step_1']) && isset($data['step_2']) && isset($data['step_3']) && isset($data['step_4']))) {
            return $this->apiResponse(['errors' => ['token' => __('common.missing-steps')]], false, 422);
        }

        // update registration token
        $data = json_decode($regToken->data, true);
        $data['step_5'] = [
            'mobile_number' => $validated['mobile_number'],
        ];
        $details = [
            'email' => $data['step_1']['email'],
            'firstname' => $data['step_2']['firstname'],
            'surname' => $data['step_2']['surname'],
            'mobile_number' => $data['step_5']['mobile_number'],
        ];
        $regToken->update([
            'step' => 5,
            'data' => json_encode($data),
        ]);

        // check if email already exists
        if (User::email($details['email'])->exists()) {
            return $this->apiResponse(['errors' => ['email' => __('common.exists', ['field' => 'Email'])]], false, 422);
        }

        // save user
        $user = $this->createUser($regToken->token);

        if($user->id) {
            return $this->apiResponse(['complete' => true, 'next_step' => -1, 'account' => $details]);
        }

        return $this->apiResponse(['errors' => ['token' => __('common.unable-create', ['field' => 'user account'])]], false, 422);
    }

    /**
     * Create a new user record out of the $regtoken data
     * @param string $token
     * @return \App\Models\User
     */
    protected function createUser($token) : \App\Models\User
    {
        $user = new User();

        // latest data
        $regToken = UsersRegistrations::regToken($token)->first();
        $data = json_decode($regToken->data, true);

        if(isset($data['step_5']['mobile_number'])) {
            $user = $user->create([
                'username'              => $data['step_1']['email'], // email for now
                'email'                 => $data['step_1']['email'],
                'firstname'             => $data['step_2']['firstname'],
                'lastname'              => $data['step_2']['surname'],
                'mobile'                => $data['step_5']['mobile_number'],
                'salutation'            => $data['step_2']['salutation'],
                'title'                 => $data['step_2']['title'],
                'birthday'              => $data['step_2']['birthday'],

                // xxx: unable to find the password in the form?
                'password' => \Hash::make('password'),
            ]);

            UsersDetails::create([
                'user_id'               => $user->id,
                'street'                => $data['step_3']['street'],
                'house_no'              => $data['step_3']['house_no'],
                'zip'                   => $data['step_3']['zip'],
                'city'                  => $data['step_3']['city'],
                'country'               => $data['step_3']['country'],
                'marital_status'        => $data['step_4']['marital_status'],
                'profession'            => $data['step_4']['profession'],
                'place_of_birth'        => $data['step_4']['place_of_birth'],
                'country_of_birth'      => $data['step_4']['country_of_birth'],
                'nationality'           => $data['step_4']['nationality'],
                'second_nationality'    => $data['step_4']['second_nationality'] ?? '',
                'country_tax_residence' => $data['step_4']['country_tax_residence'],
                'country_us_tax'        => $data['step_4']['country_us_tax'] ?? 0,
            ]);
        }

        return $user;
    }
}
