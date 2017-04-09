<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ViolationImage extends Model
{
    protected $table = 'violation_images';
    
    public function violation()
    {
        return $this->belongsTo('App\Models\Violation');
    }

}
