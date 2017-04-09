<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\UserVisit;

/**
 * Class UserVisitTransformer
 * @package namespace App\Transformers;
 */
class UserVisitTransformer extends TransformerAbstract
{

    /**
     * Transform the \UserVisit entity
     * @param \UserVisit $model
     *
     * @return array
     */
    public function transform(UserVisit $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
