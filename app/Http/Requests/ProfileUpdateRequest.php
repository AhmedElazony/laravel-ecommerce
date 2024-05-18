<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday' => ['date'],
            'gender' => [Rule::in(['male', 'female'])],
            'street' => ['string', 'max:255', 'nullable'],
            'city' => ['string', 'max:255', 'nullable'],
            'state' => ['string', 'max:255', 'nullable'],
            'postal_code' => ['string', 'max:255', 'nullable'],
            'country' => ['required', 'string', 'size:2', 'nullable'],
            'locale' => ['string', 'min:2', 'max:3', 'nullable'],
        ];
    }
}
