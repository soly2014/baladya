<?php

namespace App\Presenters;

use App\Transformers\HealthEnvTypeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class HealthEnvTypePresenter
 *
 * @package namespace App\Presenters;
 */
class HealthEnvTypePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new HealthEnvTypeTransformer();
    }
}
