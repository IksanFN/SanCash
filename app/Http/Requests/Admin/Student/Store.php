<?php

namespace App\Http\Requests\Admin\Student;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'unique:students'],
            'kelas_id' => ['required'],
            'jurusan_id' => ['required'],
            'gender' => ['required', 'in:Male,Female'],
            'phone' => ['required', 'numeric', 'min:6'],
            'alamat' => ['nullable'],
        ];
    }
}
