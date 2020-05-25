<?php


namespace App\Repositories;


use App\Models\Note;
use App\Repositories\Contracts\NoteContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class NoteEloquentRepository implements NoteContract
{
    /**
     * @param int $userId
     * @param int $noteId
     * @return Note
     * @throws ModelNotFoundException
     */
    public function findFromUserWhereNoteId(int $userId, int $noteId): Note
    {
        return Note::whereUserId($userId)->findOrFail($noteId);
    }

    /**
     * @param int $userId
     * @return Collection
     */
    public function findFromUserWhereId(int $userId): Collection
    {
        return Note::oldest()->whereUserId($userId)->get();
    }
}
