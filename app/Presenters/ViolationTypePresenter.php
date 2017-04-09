<?php

namespace App\Presenters;

use App\Transformers\ViolationTypeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ViolationTypePresenter
 *
 * @package namespace App\Presenters;
 */
class ViolationTypePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ViolationTypeTransformer();
    }
}
