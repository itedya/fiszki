<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flashcard_folder_has_flashcards', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('flashcard_folder_id');
            $table->unsignedBigInteger('flashcard_id');

            $table->timestamps();

            $table->foreign('flashcard_folder_id')->references('id')->on('flashcard_folders');
            $table->foreign('flashcard_id')->references('id')->on('flashcards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flashcard_folder_has_flashcards');
    }
};
