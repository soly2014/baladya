<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class Violation extends Model implements Transformable {

    use TransformableTrait;

    protected $table = 'violation';
    protected $fillable = [
        'date',
        'code',
        'res_quar_id',
        'street_id',
        'service_id',
        'violation_type_id',
        'violation_status_id',
        'penalty_id',
        'custom_penalty',
        'user_id',
        'address',
        'longitude',
        'latitude',
        'desc',
        'video',
        'voice'
    ];
    public $timestamps = false;

    public function resQuar(){
        return $this->belongsTo('App\Models\ResQuar','res_quar_id','id');
    }

    public function service(){
        return $this->belongsTo('App\Models\Service','service_id','id');
    }

    public function images(){
        return $this->hasMany(ViolationImage::class);
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function street()
    {
        # code...
        return $this->belongsTo('App\Models\Street','street_id','id');
    }

    public function type()
    {
        # code...
        return $this->belongsTo('App\Models\ViolationType','violation_type_id','id');
    }

    public function status()
    {
        # code...
        return $this->belongsTo('App\Models\ViolationStatus','violation_status_id','id');
    }

    public function penalty()
    {
        # code...
        return $this->belongsTo('App\Models\Penalty','penalty_id','id');
    }

    public function violationtype()
    {
        # code...
        return $this->belongsTo('App\Models\ViolationType','violation_type_id','id');
    }
    
    public function solution()
    {
        return $this->hasMany('App\Solution');        
    }
}
