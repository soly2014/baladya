<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\FacilityStatus;

/**
 * Class FacilityStatusTransformer
 * @package namespace App\Transformers;
 */
class FacilityStatusTransformer extends TransformerAbstract
{

    /**
     * Transform the \FacilityStatus entity
     * @param \FacilityStatus $model
     *
     * @return array
     */
    public function transform(FacilityStatus $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
