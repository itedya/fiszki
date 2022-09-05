<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlashcardFolders\CreateFlashardFolderRequest;
use App\Models\FlashcardFolder;

class FlashcardFolderController extends Controller
{
    public function get()
    {

    }

    public function create(CreateFlashardFolderRequest $request): FlashcardFolder
    {
        $data = $request->validated();

        $folder = new FlashcardFolder();
        $folder->name = $data['names'];
        $folder->save();

        return $folder;
    }

    public function update()
    {

    }

    public function remove()
    {

    }
}
