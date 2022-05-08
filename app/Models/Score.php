<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'maths', 'sceince', 'history', 'term'
    ];

    protected $appends = ['total', 'created'];

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id', 'id');
    }

    public function getTotalAttribute()
    {
        return $this->attributes['maths'] + $this->attributes['sceince'] + $this->attributes['history'];
    }

    public function getCreatedAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('M j, Y h:i A');
    }
}