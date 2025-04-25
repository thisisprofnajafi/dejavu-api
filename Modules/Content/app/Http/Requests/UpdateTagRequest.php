<?php

namespace Modules\Content\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateTagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('author'));
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $tagMin = config('content.validation.tag_min', 2);
        $tagMax = config('content.validation.tag_max', 20);
        
        return [
            'name' => [
                'sometimes',
                'required',
                'string',
                "min:{$tagMin}",
                "max:{$tagMax}",
                Rule::unique('tags', 'name')->ignore($this->tag)
            ],
            'slug' => [
                'sometimes',
                'required',
                'string',
                Rule::unique('tags', 'slug')->ignore($this->tag)
            ],
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->filled('name') && !$this->filled('slug')) {
            $this->merge([
                'slug' => \Str::slug($this->name)
            ]);
        }
    }
} 