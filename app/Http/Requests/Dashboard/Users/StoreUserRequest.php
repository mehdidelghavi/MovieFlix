<?php

namespace App\Http\Requests\Dashboard\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasPermissionTo('users.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'family' => ['required', 'string'],
            'email' => ['required', 'email' , 'unique:users,email'],
            'password' => ['required'],
            'phone' => ['required', 'unique:users,phone'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,png,webp'],
            'roles' => ['required']
        ];
    }
}
