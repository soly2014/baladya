<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Activity extends Model implements Transformable {

    use TransformableTrait;

    protected $table = 'activity';
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;

    public function healthenvtypes()
    {
        # code...
        return $this->belongsToMany('App\Models\HealthEnvType','health_activity');
    }

}
