<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'phone',
        'address',
        'password',
        'father_alive',
        'father_age',
        'father_job',
        'father_disease',
        'mother_alive',
        'mother_age',
        'mother_job',
        'mother_disease',
        'boys',
        'girls',
        'capicity'
    ];

}
