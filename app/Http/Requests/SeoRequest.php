<?php

namespace App\Http\Requests;

use App\Helpers\HttpResponseHelper;
use Illuminate\Foundation\Http\FormRequest;

class SeoRequest extends FormRequest
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
        $seo_id = $this->route('SEO');
        return [
            'title' => 'required|min:3|string',
            'type' => 'required',
            'blog_id' => 'exists:blogs,blog_id|unique:s_e_o_s,blog_id',
           'page_name' => 'nullable|string|unique:s_e_o_s,page_name,' . $seo_id . ',seo_id',
        ];
    }

    /** response */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        return HttpResponseHelper::errorResponse($validator->errors()->all(), 422);
    }
}
