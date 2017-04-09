<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\ViolationType;

/**
 * Class ViolationTypeTransformer
 * @package namespace App\Transformers;
 */
class ViolationTypeTransformer extends TransformerAbstract
{

    /**
     * Transform the \ViolationType entity
     * @param \ViolationType $model
     *
     * @return array
     */
    public function transform(ViolationType $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
