<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
           
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
                'video_url' => 'required|url', 
        
        ];
    }

    public function messages()
    {
        return [
            'required'=>'This Field :attribute Is required from ?CourseRequest',
            'unique'=>'This :attribute aleardy exists! ?from CourseRequest',
            'string'=>'This :attribute must be string! ?from CourseRequest',
            'url'=>'This :attribute must be url! ?from CourseRequest',
            'numeric'=>'This :attribute must be numeric! ?from CourseRequest',
        ]; 
    }
}
