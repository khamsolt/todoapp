<?php


namespace App\Services;


use App\Models\Note;
use App\Repositories\Contracts\NoteContract as NoteRepository;
use App\Services\Contracts\NoteContract;
use Illuminate\Auth\AuthManager;
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
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->repository->findFromUserWhereId($this->authManager->guard()->id());
    }

    /**
     * @param array $data
     * @return Note
     * @throws Throwable
     */
    public function create(array $data): Note
    {
        $note = Note::make($data);
        $note->user()
            ->associate($this->authManager->guard()->user());
        $note->saveOrFail();
        return $note;
    }

    /**
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data, int $id): bool
    {
        $note = $this->repository->findFromUserWhereNoteId($this->authManager->guard()->id(), $id);
        try {
            //instead update method
            return $note->fill($data)->saveOrFail();
        } catch (Throwable $e) {
            //TODO error logic
        }
        return false;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        try {
            return $this->repository->findFromUserWhereNoteId($this->authManager->guard()->id(), $id)->delete();
        } catch (\Exception $e) {
            // TODO
        }
        return false;
    }
}
