<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\ResQuarRepository;
use App\Models\ResQuar;
use App\Validators\ResQuarValidator;

/**
 * Class ResQuarRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ResQuarRepositoryEloquent extends BaseRepository implements ResQuarRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ResQuar::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ResQuarValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
