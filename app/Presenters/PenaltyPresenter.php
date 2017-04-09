<?php

namespace App\Presenters;

use App\Transformers\PenaltyTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PenaltyPresenter
 *
 * @package namespace App\Presenters;
 */
class PenaltyPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PenaltyTransformer();
    }
}
