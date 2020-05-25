<?php


namespace App\Repositories;


use App\Models\Note;
use App\Repositories\Contracts\NoteContract;
use Illuminate\Support\Collection;

class NoteEloquentRepository implements NoteContract
{
    public function findFromUserWhereNoteId(int $userId, int $noteId): Note
    {
        return Note::whereUserId($userId)->findOrFail($noteId);
    }

    public function findFromUserWhereId(int $userId): Collection
    {
        return Note::oldest()->whereUserId($userId)->get();
    }
}
