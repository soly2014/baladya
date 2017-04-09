<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class HealthEnvType extends Model implements Transformable {

    use TransformableTrait;

    protected $table = 'health_env_type';
    protected $fillable = [
        'name',
        'desc',
        'status',
    ];
    public $timestamps = false;

    public function activities()
    {
        # code...
        return $this->belongsToMany('App\Models\Activity','health_activity');
    }

}
