<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fair extends Model
{

    protected $fillable = [
        'year',
        'name',
        'logo',
        'value'
    ];
    public function scopeNow($query)
    {
        return $query->where('year', session('year'))->first();
    }
    public function scopeNowid($query)
    {
        return $query->where('year', session('year'))->first()->id;
    }
}
