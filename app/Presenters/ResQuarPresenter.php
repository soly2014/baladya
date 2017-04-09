<?php

namespace App\Presenters;

use App\Transformers\ResQuarTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ResQuarPresenter
 *
 * @package namespace App\Presenters;
 */
class ResQuarPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ResQuarTransformer();
    }
}
