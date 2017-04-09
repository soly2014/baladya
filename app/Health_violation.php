<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Health_violation extends Model
{
    //
    protected $table = 'health_violation';

    protected $fillable = [
         'visit_id' ,'facility_status_id','notice'
    ];

    public function healthenvtypes()
    {
    	# code...
    	return $this->belongsToMany('App\Models\HealthEnvType','hv_violation_type');
    }

    public function visit()
    {
        return $this->belongsTo('App\Models\UserVisit');
    }
}
