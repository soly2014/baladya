<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\ViolationStatus;

/**
 * Class ViolationStatusTransformer
 * @package namespace App\Transformers;
 */
class ViolationStatusTransformer extends TransformerAbstract
{

    /**
     * Transform the \ViolationStatus entity
     * @param \ViolationStatus $model
     *
     * @return array
     */
    public function transform(ViolationStatus $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
