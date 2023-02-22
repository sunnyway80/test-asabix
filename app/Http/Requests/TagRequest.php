<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
     * @return array<string, array|\Illuminate\Contracts\Validation\Rule|string>
     */
    public function rules(): array
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {
            $rules[$locale] = [
                'nullable',
            ];
            $rules[$locale . '.name'] = [
                'required_with:' . $locale,
                'string',
                'max:255',
            ];
        }

        return $rules;
    }
}
