<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;


class Cart extends Model
{

    protected $primaryKey = 'cart_id';

    protected $fillable = [
        'user_id',
        'product_id',
        'product_title',
        'image1',
        'quantity',
        'size',
        'price',
        'order_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public static function logActivity($user, $action, $details)
    {
        activity()
            ->causedBy($user)
            ->withProperties([
                'action_performed' => $action,
                'details' => $details,
            ])
            ->log('Cart activity');
    }
}