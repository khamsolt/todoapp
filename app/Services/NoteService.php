<?php


namespace App\Services;


use App\Models\Note;
use App\Repositories\Contracts\NoteContract as NoteRepository;
use App\Services\Contracts\NoteContract;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Throwable;

/**
 * Class NoteService
 * @package App\Services
 */
class NoteService implements NoteContract
{
    /** @var NoteRepository */
    private $repository;
    /** @var AuthManager */
    private $authManager;

    /**
     * NoteService constructor.
     * @param AuthManager $authManager
     * @param NoteRepository $repository
     */
    public function __construct(AuthManager $authManager, NoteRepository $repository)
    {
        $this->authManager = $authManager;
        $this->repository = $repository;
    }

    /**
     * @param int $userId
     * @return Collection
     */
    public function all(int $userId): Collection
    {
        return $this->repository->findFromUserWhereId($userId);
    }

    /**
     * @param int $userId
     * @param int $noteId
     * @return Note
     * @throws ModelNotFoundException
     */
    public function find(int $userId, int $noteId): Note
    {
        return $this->repository->findFromUserWhereNoteId($userId, $noteId);
    }

    /**
     * @param array $data
     * @param int $userId
     * @return Note
     * @throws Throwable
     */
    public function create(array $data, int $userId): Note
    {
        $note = Note::make($data);
        $note->user()
            ->associate($userId);
        $note->saveOrFail();
        return $note;
    }

    /**
     * @param array $data
     * @param int $userId
     * @param int $noteId
     * @return bool
     */
    public function update(array $data, int $userId, int $noteId): bool
    {
        $note = $this->repository->findFromUserWhereNoteId($userId, $noteId);
        return $note->fill($data)->saveOrFail();
    }

    /**
     * @param int $userId
     * @param int $id
     * @return bool
     */
    public function delete(int $userId, int $id): bool
    {
        try {
            return $this->repository->findFromUserWhereNoteId($userId, $id)->delete();
        } catch (\Exception $e) {
            // TODO
        }
        return false;
    }
}
