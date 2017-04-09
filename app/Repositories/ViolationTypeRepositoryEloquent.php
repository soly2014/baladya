<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\violationTypeRepository;
use App\Models\ViolationType;
use App\Validators\ViolationTypeValidator;

/**
 * Class ViolationTypeRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ViolationTypeRepositoryEloquent extends BaseRepository implements ViolationTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ViolationType::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ViolationTypeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
