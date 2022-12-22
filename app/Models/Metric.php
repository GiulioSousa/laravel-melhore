<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    use HasFactory;

    /**
     * Attributes that are mass assignable.
     * 
     * @var string[]
     */
    protected $fillable = [
        'date',
        'metric_data'
    ];
}
