<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Service;

/**
 * Class ServiceTransformer
 * @package namespace App\Transformers;
 */
class ServiceTransformer extends TransformerAbstract {

    /**
     * Transform the \Service entity
     * @param \Service $model
     *
     * @return array
     */
    public function transform(Service $model) {
        return [
            'id' => (int) $model->id,
            'name' => $model->name,
        ];
    }

}
