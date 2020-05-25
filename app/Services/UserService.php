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
     * @param int $id
     * @return bool
     * @throws Throwable
     */
    public function update(array $data, int $id): bool
    {
        $user = $this->repository->findFromUserWhereNoteId($id);
        return $user->fill($data)->saveOrFail();
    }
}
