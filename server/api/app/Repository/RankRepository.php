<?php
namespace App\Repository;

use App\Jobs\ProcessRank;
use App\Models\Rank;
use App\Models\Score;
use Illuminate\Support\Facades\DB;

class RankRepository {

    public const PAGE_HOME= 10;
    public const PAGE_SIZE = 50;

    public function updateRanks(Score $score) :void {
        $queue = new ProcessRank($score);
        $queue->dispatch($score);
    }

    public function getTopResults(){

        $top_results = Rank::selectRaw('
                                ranks.current_score,
                                users.name,
                                users.id,
                                users.image,
                                countries.name as country,
                                RANK() OVER (ORDER BY ranks.current_score) as Rank')
                            ->join('users', 'users.id', '=', 'ranks.user_id')
                            ->join('countries', 'users.country_id', '=', 'countries.id')
                            ->paginate(self::PAGE_SIZE);

        if ($top_results->isEmpty()){
            return response()->json(["Message: " => 'Users not found'], 404);
        }
        return response()->json($top_results, 200);
    }
}
