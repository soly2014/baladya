<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Service extends Model implements Transformable {

    use TransformableTrait;

    protected $table = 'service';
    protected $fillable = [
        'name',
    ];
    public $timestamps = false;


    public function violations(){
        return $this->hasMany('App\Models\Violation','service_id','id');
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
