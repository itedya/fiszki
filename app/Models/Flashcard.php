<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flashcard extends Model
{
    use HasFactory;


    public function folders(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(FlashcardFolder::class, 'folder_id', 'id');
    }
}
