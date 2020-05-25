<?php


namespace App\Repositories\Contracts;


interface RepositoryContract
{
    public function findFromUserWhereNoteId(int $userId, int $noteId);
}
