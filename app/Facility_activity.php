<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility_activity extends Model
{
    //
    protected $table = 'facility_activity';

    protected $fillable = [
         'facility_id' ,'activity_id'
    ];
}
