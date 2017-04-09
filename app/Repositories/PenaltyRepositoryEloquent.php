<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\penaltyRepository;
use App\Models\Penalty;
use App\Validators\PenaltyValidator;

/**
 * Class PenaltyRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PenaltyRepositoryEloquent extends BaseRepository implements PenaltyRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Penalty::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PenaltyValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
