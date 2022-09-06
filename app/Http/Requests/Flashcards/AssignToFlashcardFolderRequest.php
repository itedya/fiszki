<?php

namespace App\Http\Requests\Flashcards;

use Illuminate\Foundation\Http\FormRequest;

class AssignToFlashcardFolderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'flashcard_id' => ['required', 'integer', 'min:1', 'exists:flashcards,id'],
            'flashcard_folder_id' => ['required', 'integer', 'min:1', 'exists:flashcard_folders,id']
        ];
    }
}
