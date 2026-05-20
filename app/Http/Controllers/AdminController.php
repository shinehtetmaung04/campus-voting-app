<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // King votes
        $kingVotes = Vote::join('selection', 'vote.sel_id', '=', 'selection.sel_id')
                         ->where('selection.gender', 'M')
                         ->pluck('vote.count')
                         ->toArray();

        $kingLabels = Vote::join('selection', 'vote.sel_id', '=', 'selection.sel_id')
                          ->where('selection.gender', 'M')
                          ->pluck('selection.name')
                          ->toArray();

        // Queen votes
        $queenVotes = Vote::join('selection', 'vote.sel_id', '=', 'selection.sel_id')
                          ->where('selection.gender', 'F')
                          ->pluck('vote.count')
                          ->toArray();

        $queenLabels = Vote::join('selection', 'vote.sel_id', '=', 'selection.sel_id')
                           ->where('selection.gender', 'F')
                           ->pluck('selection.name')
                           ->toArray();

        return view('VotingSystem.admin_dashboard', compact('kingVotes', 'kingLabels', 'queenVotes', 'queenLabels'));
    }

    

// Admin Voting Count

    public function adminvotecount( $code){
        if ($code === "vote12345") {

        $data = Vote::join('selection', 'vote.sel_id', '=', 'selection.sel_id')
                    ->get();

        return view('VotingSystem.votecount', compact('data'));
    }
    }
}
