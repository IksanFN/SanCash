<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->role == 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'nisn' => 'nullable|numeric|unique:users',
            'email' => 'required|unique:users',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,svg',
            'role' => 'required',
            'password' => 'required|min:6'
        ];
    }
}
