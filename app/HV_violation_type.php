<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HV_violation_type extends Model
{
    //
    protected $table = 'hv_violation_type';

    protected $fillable = [
         'health_violation_id' ,'health_env_type_id'
    ];
}
