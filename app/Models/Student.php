<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'age', 'gender', 'teacher_id', 'status'
    ];

    protected $appends = ['sex'];

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher_id', 'id');
    }

    public function getSexAttribute()
    {
        return !$this->attributes['gender'] ? 'M' : 'F';
    }
}