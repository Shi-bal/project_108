<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id'; // Define the primary key

    public static function logActivity($user, $action, $details)
    {
        activity()
            ->causedBy($user)
            ->withProperties([
                'action_performed' => $action,
                'details' => $details,
            ])
            ->log('Product activity');
    }

}
