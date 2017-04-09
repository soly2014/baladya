<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\HealthEnvType;

/**
 * Class HealthEnvTypeTransformer
 * @package namespace App\Transformers;
 */
class HealthEnvTypeTransformer extends TransformerAbstract
{

    /**
     * Transform the \HealthEnvType entity
     * @param \HealthEnvType $model
     *
     * @return array
     */
    public function transform(HealthEnvType $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
