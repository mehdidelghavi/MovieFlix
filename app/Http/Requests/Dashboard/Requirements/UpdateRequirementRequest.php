<?php

namespace App\Http\Requests\Dashboard\Requirements;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequirementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasPermissionTo('requirements.update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'thumbnail' => ['nullable', 'mimes:jpg,png,webp'],
            'icon' => ['required', 'string'],
            'text' => ['required'],
            'group-a' => ['nullable'],
            'groupd-a.*.file' => ['mimes:exe,png,jpg,zip,7zip,tar,dmg,iso,rar']
            // 'groupd-a.*.title' => [],
            // 'groupd-a.*.format' => [],
            // 'groupd-a.*.size' => [],
        ];
    }
}
