<?php

namespace App\Http\Requests\FlashcardFolders;

use App\Http\Requests\JsonFormRequest;

class GetFlashcardFolderRequest extends JsonFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => ['integer', 'exists:users,id']
        ];
    }
}
