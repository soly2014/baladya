<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Penalty;

/**
 * Class PenaltyTransformer
 * @package namespace App\Transformers;
 */
class PenaltyTransformer extends TransformerAbstract
{

    /**
     * Transform the \Penalty entity
     * @param \Penalty $model
     *
     * @return array
     */
    public function transform(Penalty $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
