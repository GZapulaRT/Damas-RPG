<?php
namespace App\Repository;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreRepository {
    private $score;

    public function __construct(Score $score) {
        $this->score = $score;
    }

    public function store(Request $request){
        $score = $this->score::create([
            'user_id' => $request->user_id,
            'change' => $request->change
        ]);

        $updateRanksJob= new RankRepository;
        $updateRanksJob->updateRanks($score);
        return response()->json(['message: ' => 'Score added sucessfuly'], 201);
        //criar evento de atualizar rank
    }
}
