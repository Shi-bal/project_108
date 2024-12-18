<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Wishlist extends Model
{
    use HasFactory;


    protected $table = 'wishlists';

    protected $primaryKey = 'wishlist_id';
    


    protected $fillable = [
        'user_id',
        'product_id',
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
            ->log('Wishlist activity');
    }


}
