<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'name'=>'required|string',
            'email'=>'email|required|unique:users',
            'password'=>'required|min:6',
        ];
    }

     public function messages()
    {
        return [
            'required'=>'This Field :attribute Is required from ?AuthRequest',
            'string'=>'This :attribute must be string! ?from AuthRequest',
            'email'=>'This :attribute must be Email! ?from AuthRequest',
        ]; 
    }
}
