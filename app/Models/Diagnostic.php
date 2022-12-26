<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    use HasFactory;

    /** 
     * Attributes that are mass assignable.
     * 
     * @var string[]
     */
    protected $fillable = [
        'diagnostic_text'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
