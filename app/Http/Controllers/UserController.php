<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserController extends Controller
{
    // Method to authenticate user by login_code
    public function auth(Request $request)
{
    $request->validate([
        'login_code' => 'required',
    ]);

    $user = \App\Models\User::where('login_code', $request->input('login_code'))->first();

    if ($user) {
        // Store login_code in session
        session(['login_code' => $user->login_code]);

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful'
        ]);
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'Login Failed: User not found'
        ], 404);
    }
}




    public function uservote(Request $request){
        $loginCode = session('login_code');


        // Find the user by login_code
        $user = User::where('login_code', $loginCode)->first();

        if ($user) {
            session([''=> $user->email]);

        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }
    }


    // User Vote for King

public function voteKing(Request $request, $id)
{
    $loginCode = session('login_code');
    $user = User::where('login_code', $loginCode)->first();

    if (!$user) {
        return redirect()->back()->with('error', 'User not found');
    }

    if ($user->kflag == 0) {
        return redirect()->back()->with('error', 'You have already voted for king');
    }

    // Get selection (King)
    $selection = DB::table('selection')->where('sel_id', $id)->first();

    if (!$selection) {
        return redirect()->back()->with('error', 'Selection not found');
    }

    // Mark user as voted
    $user->kflag = 0;
    $user->kvoting_time = Carbon::now('Asia/Yangon');
    $user->save();

    // Increment vote count
    DB::table('vote')
        ->where('sel_id', $id)
        ->increment('count');

    // Success modal text
    return redirect()->back()->with('vote_success', $selection->name);
}

// User Vote for Queen
public function voteQueen(Request $request, $id)
{
    $loginCode = session('login_code');
    $user = User::where('login_code', $loginCode)->first();

    if (!$user) {
        return redirect()->back()->with('error', 'User not found');
    }

    if ($user->qflag == 0) {
        return redirect()->back()->with('error', 'You have already voted for queen');
    }

    // Get selection (Queen)
    $selection = DB::table('selection')->where('sel_id', $id)->first();

    if (!$selection) {
        return redirect()->back()->with('error', 'Selection not found');
    }

    // Mark user as voted
    $user->qflag = 0;
    $user->qvoting_time = Carbon::now('Asia/Yangon');
    $user->save();

    // Increment vote count
    DB::table('vote')
        ->where('sel_id', $id)
        ->increment('count');

    // Success modal text
    return redirect()->back()->with('vote_success', $selection->name);
}


}
