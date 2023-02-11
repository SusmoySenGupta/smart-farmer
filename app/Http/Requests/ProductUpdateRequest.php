<?php

namespace App\Http\Requests;

use App\Rules\CheckProductTitleRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->isFarmer();
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function failedAuthorization()
    {
        return redirect()->route('products.index')->with('error', 'You are not allowed to create a product.');
    }

    public function prepareForValidation()
    {
        $this->merge([
            'is_active' => $this->has('active'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:100', new CheckProductTitleRule(auth()->user(), $this->product)],
            'category_id' => ['required', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0', 'max:99999'],
            'stock' => ['required', 'numeric', 'min:0', 'max:99999'],
            'image' => ['nullable', 'image', 'max:2048', 'mimes:jpg,jpeg,png,gif'],
            'description' => ['required', 'string', 'max:1000'],
            'active' => ['sometimes', 'boolean'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
