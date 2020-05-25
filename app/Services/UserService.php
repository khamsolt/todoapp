<?php


namespace App\Services;


use App\Repositories\Contracts\UserContract as UserContractRepository;
use App\Services\Contracts\UserContract;
use Throwable;

class UserService implements UserContract
{
    private $repository;

    /**
     * UserService constructor.
     * @param UserContractRepository $repository
     */
    public function __construct(UserContractRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @param int $userId
     * @param int $noteId
     * @return bool
     * @throws Throwable
     */
    public function update(array $data,int $userId, int $noteId): bool
    {
        $user = $this->repository->findFromUserWhereNoteId($userId, $noteId);
        return $user->fill($data)->saveOrFail();
    }
}
