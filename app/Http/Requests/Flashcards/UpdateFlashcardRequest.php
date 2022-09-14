<?php

namespace App\Http\Requests\Flashcards;

use App\Http\Requests\JsonFormRequest;

class UpdateFlashcardRequest extends JsonFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => ['required', 'integer', 'min:1', 'exists:flashcards,id'],
            'front' => ['required', 'string', 'min:1', 'max:500'],
            'back' => ['required', 'string', 'min:1', 'max:500'],
            'comment_front' => ['string', 'min:1', 'max:1000'],
            'comment_back' => ['string', 'min:1', 'max:1000']
        ];
    }
}
