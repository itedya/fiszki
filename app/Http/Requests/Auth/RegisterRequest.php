<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\JsonFormRequest;

class RegisterRequest extends JsonFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'min:6', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:128']
        ];
    }
}
