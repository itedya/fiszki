<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("users_have_flashcard_folders", function (Blueprint $schema) {
            $schema->unsignedBigInteger("user_id");
            $schema->unsignedBigInteger("flashcard_folder_id");

            $schema->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("users_have_flashcard_folders");
    }
};
