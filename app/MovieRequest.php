<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'mr_name',
    ];
}
