<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\ResQuar;

/**
 * Class ResQuarTransformer
 * @package namespace App\Transformers;
 */
class ResQuarTransformer extends TransformerAbstract {

    /**
     * Transform the \ResQuar entity
     * @param \ResQuar $model
     *
     * @return array
     */
    public function transform(ResQuar $model) {
        return [
            'id' => (int) $model->id,
            'name' => $model->name,
            'desc' => $model->desc,
            'status' => (int) $model->status,
        ];
    }

}
