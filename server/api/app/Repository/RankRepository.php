<?php
namespace App\Repository;

use App\Jobs\ProcessRank;
use App\Models\Rank;
use App\Models\Score;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

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

        return $top_results;
    }
    public function getSpecificRank(int $id) {
        //TODO. not working at all lol 
        $user_rank = Rank::selectRaw("COUNT(*)+1 as rank")
            ->whereRaw("current_score > (SELECT current_score 
                                        FROM ranks 
                                        WHERE user_id = {$id})")
                            ->get();
        return $user_rank[0]->rank;
    }

}
