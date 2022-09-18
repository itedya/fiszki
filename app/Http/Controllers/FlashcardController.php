<?php

namespace App\Http\Controllers;

use App\Http\Requests\Flashcards\AssignToFlashcardFolderRequest;
use App\Http\Requests\Flashcards\CreateFlashcardRequest;
use App\Http\Requests\Flashcards\GetFlashcardsInFolderRequest;
use App\Http\Requests\Flashcards\UpdateFlashcardRequest;
use App\Models\Flashcard;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class FlashcardController extends Controller
{
    private function isFlashcardAssignedToFolder(int $flashcardId, int $flashcardFolderId): int
    {
        return DB::table("flashcard_folders_have_flashcards")
            ->where("flashcard_id", $flashcardId)
            ->where("flashcard_folder_id", $flashcardFolderId)
            ->count();
    }

    public function get(GetFlashcardsInFolderRequest $request)
    {
        $data = $request->validated();

        return Flashcard::with("folders")->whereHas('folders', function ($query) use ($data) {
            return $query->where('id', $data['id']);
        })->get();
    }

    public function assignToFlashcardFolder(AssignToFlashcardFolderRequest $request): \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        if ($this->isFlashcardAssignedToFolder($data['flashcard_id'], $data['flashcard_folder_id'])) {
            return response()->json(['errors' => ['flashcard_id' => 'Ta fiszka została już dodana do tego folderu']], 422);
        }

        $flashcard = Flashcard::find($data['flashcard_id']);

        DB::beginTransaction();
        try {
            $flashcard->folders()->attach($data['flashcard_folder_id']);

            $flashcard->save();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['errors' => ['Server error']], 500);
        }

        return response()->noContent();
    }

    public function create(CreateFlashcardRequest $request): Response
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            $flashcard = new Flashcard();
            $flashcard->front = $data['front'];
            $flashcard->back = $data['back'];

            if (isset($data['comment_front'])) {
                $flashcard->comment_front = $data['comment_front'];
            }

            if (isset($data['comment_back'])) {
                $flashcard->comment_back = $data['comment_back'];
            }

            $flashcard->folder_id = $data['folder_id'];

            $flashcard->save();
            DB::commit();

            return response()->json($flashcard, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['errors' => ['Server error']], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateFlashcardRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $flashcard = Flashcard::findOrFail($data['flashcard_id']);

        DB::beginTransaction();
        try {
            $flashcard->front = $data['front'];
            $flashcard->back = $data['back'];

            if (isset($data['comment_front'])) {
                $flashcard->comment_front = $data['comment_front'];
            }

            if (isset($data['comment_back'])) {
                $flashcard->comment_back = $data['comment_back'];
            }

            $flashcard->save();
            DB::commit();
            return response()->json($flashcard, Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['errors' => ['Server error']], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
