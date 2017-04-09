<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\FacilityStatusRepository;
use App\Models\FacilityStatus;
use App\Validators\FacilityStatusValidator;

/**
 * Class FacilityStatusRepositoryEloquent
 * @package namespace App\Repositories;
 */
class FacilityStatusRepositoryEloquent extends BaseRepository implements FacilityStatusRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return FacilityStatus::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return FacilityStatusValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
