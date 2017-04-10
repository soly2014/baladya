<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserVisit extends Model implements Transformable {

    use TransformableTrait;

    protected $table = 'user_visit';

    protected $fillable = [
        'users_id',
        'res_quar_id',
        'street_id',
        'facility_id',
        'facility_status_id',
        'date'
    ];

    public $timestamps = false;

    public function resQuar(){
        return $this->belongsTo('App\Models\UserVisit','res_quar_id','id');
    }

    public function facility()
    {
        return $this->belongsTo('App\Models\Facility');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','users_id');
    }

    
}
