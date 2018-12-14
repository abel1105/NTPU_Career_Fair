<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LectureCat extends Model
{
    protected $table = 'LectureCat';
    protected $fillable = ['title', 'fontawesome'];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function Lecture(){
        return $this->hasOne('App\Lecture','type','id');

    }

}
