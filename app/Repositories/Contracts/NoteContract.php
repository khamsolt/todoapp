<?php


namespace App\Repositories\Contracts;


use App\Models\Note;
use Illuminate\Support\Collection;

interface NoteContract extends RepositoryContract
{
    public function findFromUserWhereId(int $userId): Collection;

    public function findFromUserWhereNoteId(int $userId, int $noteId): Note;
}
