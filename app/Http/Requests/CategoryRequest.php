<?php

namespace App\Http\Requests;

use App\Helpers\HttpResponseHelper;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $category_id = $this->route('category');
        return [
            'category_name' => 'required|min:1|string|unique:categories,category_name,' . $category_id . ',category_id',
            'category_image'=>'nullable|image|max:2048',
            'paren_id'=>'nullable||exists:categories,category_id', 
            'status' => 'boolean',
             
        ];
    }

    /** response */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        return HttpResponseHelper::errorResponse($validator->errors()->all(), 422);
    }
}
