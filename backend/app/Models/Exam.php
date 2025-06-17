<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['name', 'laterality', 'comment', 'group'];

    public function packages()
    {
        return $this->belongsToMany(Package::class);
    }
}
