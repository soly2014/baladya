<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\violation_statusRepository;
use App\Models\ViolationStatus;
use App\Validators\ViolationStatusValidator;

/**
 * Class ViolationStatusRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ViolationStatusRepositoryEloquent extends BaseRepository implements ViolationStatusRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ViolationStatus::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ViolationStatusValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
