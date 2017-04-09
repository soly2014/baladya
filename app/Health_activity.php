<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Health_activity extends Model
{
    //
    protected $table = 'health_activity';

    protected $fillable = [
         'health_env_type' ,'activity_id'
    ];
}
