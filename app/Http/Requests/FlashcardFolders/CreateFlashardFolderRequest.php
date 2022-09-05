<?php

namespace App\Http\Requests\FlashcardFolders;

use Illuminate\Foundation\Http\FormRequest;

class CreateFlashardFolderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:500']
        ];
    }
}
