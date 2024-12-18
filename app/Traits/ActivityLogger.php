<?php
namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait ActivityLogger
{
    public function logActivity($action, $table, $columnData = null)
    {
        DB::table('activity_logs')->insert([
            'user_id' => Auth::id() ?? null,
            'usertype' => Auth::check() ? Auth::user()->usertype : 'Guest',
            'action_performed' => $action,
            'table_name' => $table,
            'column_data' => $columnData ? json_encode($columnData) : null,
            'created_at' => now(),
        ]);
    }
}
