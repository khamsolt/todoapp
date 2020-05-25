<?php


namespace App\Repositories\Contracts;


use App\Models\User;

interface UserContract extends RepositoryContract
{
    public function findFromUserWhereNoteId(int $id): User;
}
