<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeStructureItem extends Model
{
    protected $fillable = [
        'fee_structure_id',
        'name',
        'amount',
    ];

    public function feeStructure()
    {
        return $this->belongsTo(FeeStructure::class);
    }
}
