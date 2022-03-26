<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    protected $fillable = [
        'factoryuser_id',
        'day',
        'medical_history_value',
        'updated_at',
        'created_at',
    ];
}
