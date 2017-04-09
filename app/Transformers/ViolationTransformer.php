<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Violation;

/**
 * Class ViolationTransformer
 * @package namespace App\Transformers;
 */
class ViolationTransformer extends TransformerAbstract
{

    /**
     * Transform the \Violation entity
     * @param \Violation $model
     *
     * @return array
     */
    public function transform(Violation $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
