<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interpretation extends Model
{
    protected $fillable = ['min_score', 'max_score', 'description'];
}
