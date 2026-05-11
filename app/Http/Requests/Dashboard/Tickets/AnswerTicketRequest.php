<?php

namespace App\Http\Requests\Dashboard\Tickets;

use Illuminate\Foundation\Http\FormRequest;

class AnswerTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasPermissionTo("tickets.update");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'text' => ['required'],
            'attachment' => ['nullable', 'mimes:png,jpg,webp']
        ];
    }
}
