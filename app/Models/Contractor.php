<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Contractor extends Model implements Transformable {

    use TransformableTrait;

    protected $table = 'contractor';
    protected $fillable = [
        'name',
        'desc',
        'status',
    ];
    public $timestamps = false;

    public function resQuars()
    {
    	# code...
    	return $this->belongsToMany(ResQuar::class);
    }

}
