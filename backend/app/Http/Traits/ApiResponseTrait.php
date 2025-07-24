<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait ApiResponseTrait
{
    /**
     * Validate a request against a set of rules.
     * 
     * This method validates the request data against the given
     * rules. If the validation fails, it will return a JSON response
     * with the validation errors. If the validation succeeds, it will
     * return the validated data.
     * 
     * @param array $requestData
     * @param array $rules
     * @return array
     */
    protected function apiValidate($requestData, $rules)
    {
        $validator = Validator::make($requestData, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator, $this->apiResponse([
                'errors' => $validator->errors()
            ], false, 422));
        }

        return $validator->validated();
    }

    /**
     * Return a JSON response with the given data.
     * 
     * @param array $data
     * @param boolean $success
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function apiResponse($data, $success = true, $code = 201)
    {
        return response()->json([
            'success' => $success,
            'data' => $data,
        ], $code);
    }
}
