<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'observations',
    ];

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_package')->withTimestamps();
    }
}
