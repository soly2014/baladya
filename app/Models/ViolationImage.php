<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViolationImage extends Model
{
    //
    protected $table = 'violation_images';
    
    protected $fillable = [
        'violation_id',
        'image'
    ];
    
    public function violation()
    {
        return $this->belongsTo('App\Models\Violation');
    }

    
}
