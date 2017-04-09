<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class FacilityStatus extends Model implements Transformable {

    use TransformableTrait;

    protected $table = 'facility_status';
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;

}
