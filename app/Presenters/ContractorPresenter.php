<?php

namespace App\Presenters;

use App\Transformers\ContractorTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ContractorPresenter
 *
 * @package namespace App\Presenters;
 */
class ContractorPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ContractorTransformer();
    }
}
