<?php


namespace App\Services\Contracts;


interface UserContract
{
    public function update(array $data,int $userId, int $noteId): bool;
}
