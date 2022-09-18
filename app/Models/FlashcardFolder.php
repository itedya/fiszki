<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FlashcardFolder extends Model
{
    use HasFactory;

    public function flashcards(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Flashcard::class, 'folder_id', 'id');
    }

    public function folders(): BelongsToMany
    {
        return $this->belongsToMany(FlashcardFolder::class, 'flashcard_folders_have_flashcard_folders', 'flashcard_folder_id', 'flashcard_folder_member_id');
    }
}
