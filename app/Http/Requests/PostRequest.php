<?php

namespace App\Http\Requests;

use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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

        $rules['tags'] = [
            'nullable',
        ];

        $rules['tags.*'] = [
            'uuid',
            Rule::exists(Tag::class, 'id'),
            'distinct',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules[$locale] = [
                'nullable',
            ];
            $rules[$locale . '.title'] = [
                'required_with:' . $locale,
                'string',
                'max:255',
            ];
            $rules[$locale . '.description'] = [
                'required_with:' . $locale,
                'string',
            ];
            $rules[$locale . '.content'] = [
                'required_with:' . $locale,
                'string',
            ];
        }

        return $rules;
    }
}
