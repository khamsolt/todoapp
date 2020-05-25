<?php


namespace App\Services\Contracts;


use App\Models\Note;
use Illuminate\Support\Collection;

interface NoteContract
{
    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param array $data
     * @return Note
     */
    public function create(array $data): Note;

    /**
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
