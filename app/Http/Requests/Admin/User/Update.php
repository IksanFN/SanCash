<?php

namespace App\Http\Requests\Admin\User;

// use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
class Update extends FormRequest
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
            'email' => ['required', Rule::unique('users', 'email')->ignore($this->user->id, 'id')],
            'nisn' => ['required', Rule::unique('users', 'nisn')->ignore($this->user->id, 'id')],
            'avatar' => 'image|mimes:jpg,jpeg,png,svg',
        ];
    }
}
