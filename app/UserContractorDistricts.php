<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserContractorDistricts extends Model
{
 
    protected $table = 'contractor_res_quar';

    protected $fillable = [
        'contractor_id',
        'res_quar_id',

    ];




}
