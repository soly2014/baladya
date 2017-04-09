<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ResQuar extends Model implements Transformable {

    use TransformableTrait;

    protected $table = 'res_quar';
    
    protected $fillable = [
        'name',
        'desc',
        'status',
        'map',
        'long',
        'lat'
    ];


    public $timestamps = false;


    public function violations(){
        return $this->hasMany('App\Models\Violation','res_quar_id','id');
    }


    public function userVisits(){
        return $this->hasMany('App\Models\UserVisit','res_quar_id','id');
    }



    public function gardens(){
        return $this->hasMany(Garden::class);
    }


    public function users() {
        return $this->belongsToMany(User::class);
    }


}
