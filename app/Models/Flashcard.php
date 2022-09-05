<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flashcard extends Model
{
    use HasFactory;


    public function folders(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(FlashcardFolder::class, 'flashcard_folder_has_flashcards', 'flashcard_id', 'flashcard_folder_id');
    }
}
