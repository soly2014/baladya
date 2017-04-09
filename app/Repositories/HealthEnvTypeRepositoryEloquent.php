<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\healthEnvTypeRepository;
use App\Models\HealthEnvType;
use App\Validators\HealthEnvTypeValidator;

/**
 * Class HealthEnvTypeRepositoryEloquent
 * @package namespace App\Repositories;
 */
class HealthEnvTypeRepositoryEloquent extends BaseRepository implements HealthEnvTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return HealthEnvType::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return HealthEnvTypeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
