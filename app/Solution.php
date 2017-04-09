<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    //
    protected $table = 'violation_solutions';
    protected $fillable = [
        'user_id','description','image','violation_id','is_accepted'
    ];
    
    function solution()
    {
        return $this->belongsTo('App\Models\Violation');
    }
    
    function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}


