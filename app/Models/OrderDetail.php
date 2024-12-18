<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class OrderDetail extends Model
{
    use HasFactory;

    // Define the primary key for the model
    protected $primaryKey = 'order_detail_id'; // This is optional if you're using the default 'id'

    // Add 'order_id' to the $fillable array to allow mass assignment
    protected $fillable = [
        'order_id',
        'name',
        'email',
        'address',
        'region',
        'province',
        'city',
        'barangay',
        'phone',
        'payment_method',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public static function logActivity($user, $action, $details)
    {
        activity()
            ->causedBy($user)
            ->withProperties([
                'action_performed' => $action,
                'details' => $details,
            ])
            ->log('Order Detail activity');
    }
}