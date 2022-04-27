<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{Player, Status, Score};


class ApiScoreController extends Controller
{
 
	public function UpdateScoreData(request $request) {
		// Add a score record to our score table. Used to add all
		// score records to give us the user rank placement
		$score = new Score;
		$score->user_id = $request->user_id;
		$score->score_change = $request->score_change;
		$score->save();
		
		return response()->json([
			"message" => "essa bagaça funciona por Magica(\$seiLáOq)"
		], 201);

	}

}
