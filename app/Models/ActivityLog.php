<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'activity_logs';

    // The attributes that are mass assignable
    protected $fillable = [
        'usertype', 
        'action_performed', 
        'table_name', 
        'column_data'
    ];

    protected $casts = [
        'column_data' => 'array', // Ensures that the JSON column is cast to an array
    ];
}
