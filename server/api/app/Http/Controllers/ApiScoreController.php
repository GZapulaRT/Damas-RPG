<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Score;


class ApiScoreController extends Controller
{
 
	public function addScore(request $request) {
		// Add a score record to our score table. Used to add all
		// score records to give us the user rank placement
		$score = Score::create([
			'player_id' => $request->player_id,
			'score_change' => $request->score_change
		]);
		
		return response()->json([
			"message" => "score de {$score->score_change} adicionado ao BD"
		], 201);

	}

}
