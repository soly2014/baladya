<?php

namespace App\Repositories;

use App\Models\User;
use App\Validators\UserValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\UserRepositoryRepository;
use App\Models\UserRepository;
use App\Validators\UserRepositoryValidator;

/**
 * Class UserRepositoryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserRepositoryRepositoryEloquent extends BaseRepository implements UserRepositoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }


    /**
     * @return mixed
     */
    public function validator()
{
    return UserValidator::class;
}

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
