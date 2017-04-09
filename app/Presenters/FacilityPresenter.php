<?php

namespace App\Presenters;

use App\Transformers\FacilityTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class FacilityPresenter
 *
 * @package namespace App\Presenters;
 */
class FacilityPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new FacilityTransformer();
    }
}
