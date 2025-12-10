<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:150'],
            'content' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ];
    }
}
