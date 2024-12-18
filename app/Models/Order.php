<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;


class Order extends Model
{
    //
    use HasFactory;

    protected $primaryKey = 'order_id'; // Define the primary key


    protected $fillable = [
        'user_id',
        'total_price',
        'payment_status',
        'delivery_status',
    ];

    public static function logActivity($user, $action, $details)
    {
        activity()
            ->causedBy($user)
            ->withProperties([
                'action_performed' => $action,
                'details' => $details,
            ])
            ->log('Order activity');
    }

    
}
