<?php

namespace App\Presenters;

use App\Transformers\ViolationStatusTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ViolationStatusPresenter
 *
 * @package namespace App\Presenters;
 */
class ViolationStatusPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ViolationStatusTransformer();
    }
}
