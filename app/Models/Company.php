<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Company extends Model implements Transformable {

    use TransformableTrait;

    protected $table = 'company';
    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
        'code',
        'lyc_status',
        'lyc_start',
        'lyc_end',
        'lyc_number',
        'status',
    ];
    public $timestamps = false;

}
