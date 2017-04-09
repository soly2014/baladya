<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Garden extends Model implements Transformable {

    use TransformableTrait;

    protected $table = 'garden';
    protected $fillable = [
        'name',
        'res_quar_id',
        'desc',
        'street_id',
    ];
    public $timestamps = false;

    public function street(){
        return  $this->belongsTo(Street::class);
    }

    public function resQuar(){
        return  $this->belongsTo(ResQuar::class);
    }
}
