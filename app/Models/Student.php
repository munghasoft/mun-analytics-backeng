<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'school_id',
        'admission_no',
        'account_no',
        'first_name',
        'last_name',
        'class_name',
        'is_boarder',
        'parent_name',
        'parent_phone',
        'parent_address',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
