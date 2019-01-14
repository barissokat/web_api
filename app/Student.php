<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'topic', 'confirmed', 'advisor_id',
    ];

    public function advisor()
    {
        return $this->belongsTo(Advisor::class);
    }
}
