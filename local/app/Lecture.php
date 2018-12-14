<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $fillable = [
        'title',
        'date',
        'start',
        'end',
        'place',
        'info',
        'fair_id',
        'created_at',
        'type'
    ];
    //relationship

    public function Category(){
        return $this->hasOne('App\LectureCat','id','type');

    }
}
