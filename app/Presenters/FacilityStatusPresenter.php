<?php

namespace App\Presenters;

use App\Transformers\FacilityStatusTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class FacilityStatusPresenter
 *
 * @package namespace App\Presenters;
 */
class FacilityStatusPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new FacilityStatusTransformer();
    }
}
