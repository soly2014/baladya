<?php

namespace App\Presenters;

use App\Transformers\GardenTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class GardenPresenter
 *
 * @package namespace App\Presenters;
 */
class GardenPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new GardenTransformer();
    }
}
