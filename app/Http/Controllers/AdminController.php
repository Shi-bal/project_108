<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class AdminController extends Controller
{
    //
    public function top_buyer()
    {
        // Refresh the materialized view
        DB::statement('REFRESH MATERIALIZED VIEW top_buyers');

        // Fetch data from the materialized view
        $topBuyers = DB::table('top_buyers')->get();

        // Pass the data to the view
        return view('admin.top_buyer', ['topBuyers' => $topBuyers]);
    }

    public function show_users()
    {

        $users = DB::table('users')->get();

        return view ('admin.show_users', compact('users'));
    }

    public function remove_user($user_id)
    {
      
        DB::table('users')->where('user_id', $user_id)->delete();

        return redirect()->back()->with('success', 'User deleted successfully!');
    }

    public function edit_role(Request $request, $user_id)
    {
        // Validate the incoming request
        $request->validate([
            'usertype' => 'required|string|in:admin,seller,user', // Adjust roles as necessary
        ]);

        // Find the user by ID
        $user = User::findOrFail($user_id);

        // Update the user's role
        $user->usertype = $request->input('usertype');
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('message', 'User  role updated successfully.');
    }
}
