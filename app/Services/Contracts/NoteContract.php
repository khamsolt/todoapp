<?php


namespace App\Services\Contracts;


use App\Models\Note;
use Illuminate\Support\Collection;

interface NoteContract
{
    /**
     * @param int $userId
     * @return Collection
     */
    public function all(int $userId): Collection;

    /**
     * @param int $userId
     * @param int $noteId
     * @return Note
     */
    public function find(int $userId, int $noteId): Note;

    /**
     * @param array $data
     * @param int $userId
     * @return Note
     */
    public function create(array $data, int $userId): Note;

    /**
     * @param array $data
     * @param int $userId
     * @param int $noteId
     * @return bool
     */
    public function update(array $data, int $userId, int $noteId): bool;

    /**
     * @param int $userId
     * @param int $id
     * @return bool
     */
    public function delete(int $userId, int $id): bool;
}
