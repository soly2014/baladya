<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Garden;

/**
 * Class GardenTransformer
 * @package namespace App\Transformers;
 */
class GardenTransformer extends TransformerAbstract
{

    /**
     * Transform the \Garden entity
     * @param \Garden $model
     *
     * @return array
     */
    public function transform(Garden $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
