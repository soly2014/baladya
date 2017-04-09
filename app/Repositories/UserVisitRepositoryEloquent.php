<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\UserVisitRepository;
use App\Models\UserVisit;
use App\Validators\UserVisitValidator;

/**
 * Class UserVisitRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserVisitRepositoryEloquent extends BaseRepository implements UserVisitRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserVisit::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UserVisitValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
