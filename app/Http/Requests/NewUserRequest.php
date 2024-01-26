<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

                'username' =>'required|unique:users|min:6',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8|regex:/^(?=.*[A-Z])(?=.*[0-9])/'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Felhasználónév megadása kötelező',
            'username.unique' => 'A megadott felhasználónév már foglalt',
            'username.min' => 'A felhasználónév legalább 6 karakter hosszú kell legyen',
            'email.required' => 'E-mail cím megadása kötelező',
            'email.email' => 'Érvénytelen e-mail cím',
            'email.unique' => 'A megadott e-mail cím már foglalt',
            'password.required' => 'Jelszó megadása kötelező',
            'password.string' => 'A jelszónak karaktereket kell tartalmaznia',
            'password.min' => 'A jelszónak legalább 8 karakterből kell állnia',
            'password.regex' => 'A jelszónak legalább egy nagybetűt és egy számot kell tartalmaznia'
        ];
    }
}
