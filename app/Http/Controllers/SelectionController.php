<?php

namespace App\Http\Controllers;
use App\Models\selection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class SelectionController extends Controller
{
public function kingDetail(Request $request, $id)
{
    $king = Selection::with('images')->where('sel_id', $id)
                     ->where('gender', 'M')
                     ->firstOrFail();

    // Get the clicked image ID from URL
    $clickedImgId = $request->query('img');

    // Find the clicked image, fallback to first if not provided
    $clickedImage = $king->images->where('img_id', $clickedImgId)->first() ?? $king->images->first();

    return view('VotingSystem.king_detail', compact('king', 'clickedImage'));
}



public function queenDetail(Request $request, $id)
{
    $queen = Selection::with('images')->where('sel_id', $id)
                     ->where('gender', 'F')
                     ->firstOrFail();

    // Get the clicked image ID from URL
    $clickedImgId = $request->query('img');

    // Find the clicked image, fallback to first if not provided
    $clickedImage = $queen->images->where('img_id', $clickedImgId)->first() ?? $queen->images->first();

    return view('VotingSystem.queen_detail', compact('queen', 'clickedImage'));
}


    public function kingSelection()
{
    $kings = Selection::with('images')
                ->where('gender', 'M')
                ->get();

    return view('VotingSystem.king_selection', compact('kings'));
}

    public function queenSelection()
{
    $queens = Selection::with('images')
                ->where('gender', 'F')
                ->get();

    return view('VotingSystem.queen_selection', compact('queens'));
}



}
