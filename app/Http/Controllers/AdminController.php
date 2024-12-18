<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Traits\ActivityLogger;



use App\Models\User;

class AdminController extends Controller
{
    use ActivityLogger;

    public function __construct()
    {
        // No middleware needed here
    }

    public function top_buyer()
    {
        // Check if the user is an admin
        if (Auth::check() && Auth::user()->usertype != 'admin') {
            return redirect('/'); // Redirect if not admin
        }

        // Proceed with the function if user is an admin
        DB::statement('REFRESH MATERIALIZED VIEW top_buyers');
        $topBuyers = DB::table('top_buyers')->get();
        return view('admin.top_buyer', ['topBuyers' => $topBuyers]);
    }

    public function activity_logs()
    {
        // Check if the user is an admin
        if (Auth::check() && Auth::user()->usertype != 'admin') {
            return redirect('/'); // Redirect if not admin
        }

        // Fetch all activity logs
        $activityLogs = DB::table('activity_logs')->get();
        return view('admin.activity_logs', compact('activityLogs'));
    }

    
    public function show_users()
    {
        if (Auth::check() && Auth::user()->usertype != 'admin') {
            return redirect('/'); // Redirect if not admin
        }

        $users = DB::table('users')->get();

        

        return view ('admin.show_users', compact('users'));
    }

    public function remove_user($user_id)
    {
        // Check if the user is authenticated and has admin privileges
        if (Auth::check() && Auth::user()->usertype != 'admin') {
            return redirect('/'); // Redirect if not an admin
        }

        // Retrieve the user details before deletion
        $user = DB::table('users')->where('user_id', $user_id)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Delete the user
        DB::table('users')->where('user_id', $user_id)->delete();

        // Log the activity
        $this->logActivity(
            'Delete',
            'users',
            [
                'user_id' => $user->user_id,
                'name' => $user->name,
            ]
        );

        return redirect()->back()->with('message', 'User deleted successfully!');
    }


    public function edit_role(Request $request, $user_id)
    {
        // Validate the incoming request
        $request->validate([
            'usertype' => 'required|string|in:admin,seller,user', // Adjust roles as necessary
        ]);

        // Find the user by ID
        $user = User::find($user_id);

        if (!$user) {
            return redirect()->back()->withErrors('User not found!');
        }

        // Update the user's role
        $user->usertype = $request->input('usertype');
        $user->save();

        // Debugging: Log the fetched user ID and name
        logger()->info('Fetched User Details', [
            'user_id' => $user->user_id,
            'name' => $user->name,
        ]);

        // Log the activity
        $this->logActivity(
            'Edit',
            'users',
            [
                'user_id' => $user->user_id, // Fetch from the $user model
                'name' => $user->name,  // Fetch from the $user model
            ]
        );

        // Redirect back with a success message
        return redirect()->back()->with('message', 'User role updated successfully.');
    }


}
