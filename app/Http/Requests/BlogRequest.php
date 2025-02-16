<?php

namespace App\Http\Requests;

use App\Helpers\HttpResponseHelper;
use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
        $blog_id = $this->route('Blog');
        return [
            'title' => 'required|min:3|string',
            'content' => 'required|min:3|string',
            'short_des' => 'required|min:3|string',
            "category_id" => "required|exists:categories,category_id",
            'image' => 'required',
             
        ];
    }

    /** response */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        return HttpResponseHelper::errorResponse($validator->errors()->all(), 422);
    }
}
