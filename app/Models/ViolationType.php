<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ViolationType extends Model implements Transformable {

    use TransformableTrait;

    protected $table = 'violation_type';

    protected $fillable = [
        'name',
        'service_id',
        'duration',
        'desc',
        'max_amount',
        'amount',
        'min_amount',
        'health_env_type_id',
        'status',
    ];

    public $timestamps = false;

    public function violation(){
        return $this->hasMany(Violation::class,'violation_type_id');
    }


    
}
