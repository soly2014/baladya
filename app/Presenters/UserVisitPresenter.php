<?php

namespace App\Presenters;

use App\Transformers\UserVisitTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UserVisitPresenter
 *
 * @package namespace App\Presenters;
 */
class UserVisitPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UserVisitTransformer();
    }
}
