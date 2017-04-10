<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ViolationStatus extends Model implements Transformable {

    use TransformableTrait;

    protected $table = 'violation_status';
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;

    public function violations(){

        return $this->hasMany(Violation::class,'violation_status_id');

    }
    
}
