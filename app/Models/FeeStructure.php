<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    protected $table = 'fee_structure';
    
    protected $fillable = [
        'school_id',
        'class_name',
        'term',
        'year',
        'total_day',
        'total_boarder',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
