<?php

namespace Database\Seeders;

use App\Models\Flashcard;
use App\Models\FlashcardFolder;
use Illuminate\Database\Seeder;

class FlashcardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FlashcardFolder::factory(6)
            ->afterCreating(function ($folder) {
                Flashcard::factory(rand(0, 10))
                    ->afterMaking(function ($flashcard) use ($folder) {
                        $flashcard->folder_id = $folder->id;
                    })->create();
            })
            ->create();
    }
}
