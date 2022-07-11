<?php
namespace App\Repository;

use App\Models\Rank;
use App\Models\Score;

class ScoreRepository {

    public function updateScore($user_id, $change){
        $score = new Score;
        $score = $score::create([
            'user_id' => $user_id,
            'change' => $change
        ]);

        Rank::updateRanks($score);
        return response()->json(['message: ' => 'Score added sucessfuly'], 201);
        //criar evento de atualizar rank
    }
}
