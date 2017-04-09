<?php

namespace App\Presenters;

use App\Transformers\ViolationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ViolationPresenter
 *
 * @package namespace App\Presenters;
 */
class ViolationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ViolationTransformer();
    }
}
