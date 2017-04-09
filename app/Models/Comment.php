<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'violation_id',
        'user_id',
        'comment',
        'image',
    ];

    public function violation(){
        return $this->belongsTo(Violation::class,'violation_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
