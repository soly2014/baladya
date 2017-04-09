<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Facility;

/**
 * Class FacilityTransformer
 * @package namespace App\Transformers;
 */
class FacilityTransformer extends TransformerAbstract
{

    /**
     * Transform the \Facility entity
     * @param \Facility $model
     *
     * @return array
     */
    public function transform(Facility $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
