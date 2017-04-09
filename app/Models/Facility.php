<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Facility extends Model implements Transformable {

    use TransformableTrait;

    protected $table = 'facility';
    protected $fillable = [
        'banner_name',
        'township',
        'res_quar_id',
        'street_id',
        'lyc_name',
        'computer_number',
        'lyc_number',
        'build_number',
        'company_id',
        'activity_type_id',
        'labour_number',
        'owner_name',
        'owner_id',
        'lyc_status',
        'lyc_start',
        'lyc_end',
        'status',
        'longitude',
        'latitude',
        'map',
        'type'
    ];
    public $timestamps = false;

    public function activities()
    {
        # code...
        return $this->belongsToMany('App\Models\Activity','facility_activity');
    }

}
