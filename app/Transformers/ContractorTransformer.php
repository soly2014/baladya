<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Contractor;

/**
 * Class ContractorTransformer
 * @package namespace App\Transformers;
 */
class ContractorTransformer extends TransformerAbstract
{

    /**
     * Transform the \Contractor entity
     * @param \Contractor $model
     *
     * @return array
     */
    public function transform(Contractor $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
