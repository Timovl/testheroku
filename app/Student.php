<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function programme()
    {
        return $this->belongsTo('App\Programme')->withDefault();   // a record belongs to a genre
    }
    public function studentcourse()
    {
        return $this->hasMany('App\StudentCourse');   // a genre has many records
    }
}
