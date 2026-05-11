<?php

namespace App\Http\Requests\Dashboard\Movies;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasPermissionTo('movies.update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=> ['required'],
            'title.*' => ['string'],
            'thumbnail' => ['nullable', 'image'],
            'trailer' => ['nullable', 'mimes:mp4,mov,avi,wmv,mkv'],
            'imdb' => ['required'],
            'creation_year' => ['required', 'numeric'],
            'age' => ['required', 'numeric'],
            'country' => ['required', 'string'],
            'story' => ['required', 'string'],
            'about' => ['required', 'string'],
            'actors.*' => ['required', 'numeric'],
            'directors.*' => ['required'],
            'genres.*' => ['required'],
            'collection' => ['numeric'],
            'type' => ['required', 'string'],
            'time' => ['required'],
            'lists' => ['nullable']
        ];
    }
}
