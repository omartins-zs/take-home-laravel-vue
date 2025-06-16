<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'birthdate',
        'email',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
