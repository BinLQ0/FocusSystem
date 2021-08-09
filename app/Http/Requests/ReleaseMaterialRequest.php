<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReleaseMaterialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $product = $this->product;
        $location = $this->location;

        if (count($product) > count($location)) {
            array_pop($product);
        }

        $this->merge([
            'product' => $product,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $product_count = count($this->product);

        return [
            'lot'         => 'required|unique:releases,lot,' . optional($this->release_material)->id,
            'product_id'  => 'required',
            'product.*'   => 'required',
            'location'    => 'required|array|size:' . ($product_count)
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'lot'        => 'No. Lot',
            'product_id' => 'End Product Name',
            'product.0'  => 'Raw Material',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'product.0.required' => 'The :attribute must have at least 1 items',
            'location.size' => 'All Raw Materials must be located'
        ];
    }
}
