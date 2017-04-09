<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Street extends Model implements Transformable {

    use TransformableTrait;

    protected $table = 'street';

    protected $fillable = [
        'res_quar_id',
        'name',
        'desc',
        'map',
        'lat',
        'long',
        'status',
    ];

    public $timestamps = false;

    public function gardens(){

       return $this->hasMany(Garden::class);
       
    }

    
    function resquare()
    {
         return $this->belongsTo('App\Models\ResQuar', 'res_quar_id');
    }
    

}
