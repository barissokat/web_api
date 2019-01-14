<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advisor extends Model
{
    protected $fillable = [
        'name', 'area', 'title_id',
    ];
    
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function title()
    {
        return $this->belongsTo(Title::class);
    }
}
