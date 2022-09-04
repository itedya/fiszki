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
        Schema::create('flashcard_folder_has_flashcard_folders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('flashcard_folder_id');
            $table->unsignedBigInteger('flashcard_folder_member_id');

            $table->foreign('flashcard_folder_id', 'ff_has_ff_flashcard_folder_id')->references('id')->on('flashcard_folders');
            $table->foreign('flashcard_folder_member_id', 'ff_has_ff_flashcard_member_id')->references('id')->on('flashcard_folders');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flashcard_folder_has_flashcard_folders');
    }
};
