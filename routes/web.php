<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SelectionController;

Route::get('/', function () {
    return view('VotingSystem.home');
});

Route::get('/home', function () {
    return view('VotingSystem.home');
});

Route::get('/event', function () {
    return view('VotingSystem.event');
});

Route::get('/admin-dashboard', [AdminController::class, 'index']);


Route::get('/king_selection', [SelectionController::class, 'kingSelection']);

Route::get('/queen_selection', [SelectionController::class, 'queenSelection']);


Route::post('/login', [UserController::class, 'auth']);

Route::get('/king/{id}', [SelectionController::class, 'kingDetail']);

Route::get('/queen/{id}', [SelectionController::class, 'queenDetail']);

// Vote for King and Queen
Route::post('/vote/king/{id}', [UserController::class, 'voteKing'])->name('vote.king');

Route::post('/vote/queen/{id}', [UserController::class, 'voteQueen'])->name('vote.queen');


// generate 720 unique users with unique login codes

Route::get('/generate-users', function () {

    $count = 3;

    for ($i = 0; $i < $count; $i++) {

        // Generate a unique login code
        do {
            $code = Str::random(8); // 0-9, a-z, A-Z
        } while (DB::table('users')->where('login_code', $code)->exists());

        // Insert user row
        DB::table('users')->insert([
            'email' => "",         // blank
            'login_code' => $code,   // guaranteed unique
            'qflag' => 1,
            'qvoting_time' => "",  // blank
            'kflag' => 1,
            'kvoting_time' => "",  // blank
        ]);
    }

    return "$count unique users generated successfully!";
});

// generate 18 records in vote table
Route::get('/generate-votes', function () {
    $selectionDataCount = DB::table('selection')->count();
    for ($i = 1; $i <= $selectionDataCount; $i++) {
        DB::table('vote')->insert([
            'v_id' => $i,
            'sel_id' => $i,
            'count' => '0'
        ]);
    }

    return "$selectionDataCount vote records inserted successfully!";
});


Route::get('/massive-test', function () {

    set_time_limit(0);

    $url1 = 'http://54.179.153.84/VotingSystem/Voting/public/';

    Http::pool(fn ($pool) =>
        collect(range(1, 750))->map(fn () =>
            $pool->timeout(10)->get($url1)
        )
    );

    return 'Massive test triggered';
});

Route::get('/test-load', function () {

    set_time_limit(0); // prevent PHP timeout (CLI-like behavior)

    $url = 'http://54.179.153.84/VotingSystem/Voting/public/';

    collect(range(1, 1000))
        ->chunk(20) // 20 concurrent requests ONLY
        ->each(function ($chunk) use ($url) {

            Http::pool(fn ($pool) =>
                $chunk->map(fn () =>
                    $pool->timeout(10)->get($url)
                )
            );

            sleep(1); // CRITICAL for free tier
        });

    return response()->json([
        'status' => 'completed',
        'requests' => 1000
    ]);
});



Route::get('/admin-votingcount/{code}', [AdminController::class, 'adminvotecount'])->name('adminvote');
