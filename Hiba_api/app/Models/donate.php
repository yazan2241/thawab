<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class donate extends Model
{
    use HasFactory;
    protected $fillable = [
        'donor_id',
        'item_name'.
        'item_image',
        'item_address',
    ];
}
