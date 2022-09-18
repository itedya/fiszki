<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlashcardFolders\CreateFlashardFolderRequest;
use App\Http\Requests\FlashcardFolders\GetFlashcardFolderRequest;
use App\Models\FlashcardFolder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class FlashcardFolderController extends Controller
{
    public function get(GetFlashcardFolderRequest $request)
    {
        $data = $request->validated();

        $query = FlashcardFolder::query();

        if (isset($data['with_flashcards']) && $data['with_flashcards']) {
            $query->with(["flashcards"]);
        }

        if (isset($data['user_id']) && $data['user_id'] !== auth()->id()) {
            // TODO: Check permissions
            $query->where("owner_id", $data['user_id']);
        } else if (isset($data['id'])) {
            return $query->findOrFail($data['id']);
        } else {
            $query->where("owner_id", auth()->id());
        }

        return $query->get();
    }

    public function create(CreateFlashardFolderRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            $folder = new FlashcardFolder();
            $folder->name = $data['name'];
            $folder->owner_id = auth()->id();
            $folder->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['errors' => ['Server error!']], 500);
        }

        return response()->json($folder, Response::HTTP_CREATED);
    }
}
