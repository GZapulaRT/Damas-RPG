<?php
namespace App\Repository;

use App\Jobs\CreateUserRankJob;
use App\Jobs\ProcessRank;
use App\Models\Rank;
use App\Models\Score;
use App\Models\User;

class RankRepository {

    public const PAGE_HOME= 10;
    public const PAGE_SIZE = 50;

    public function store(User $user): void {
        $createNewRankJob = new CreateUserRankJob($user);
        $createNewRankJob->dispatch($user);
    }
    

    public function updateRanks(Score $score) :void {
        $queue = new ProcessRank($score);
        $queue->dispatch($score);
    }

    public function getTopResults(){

        $topResult = Rank::selectRaw('
                                ranks.current_score,
                                users.name,
                                users.id,
                                users.image,
                                countries.name as country,
                                RANK() OVER (ORDER BY ranks.current_score DESC) as Rank')
                            ->join('users', 'users.id', '=', 'ranks.user_id')
                            ->join('countries', 'users.country_id', '=', 'countries.id')
                            ->orderByDesc('ranks.current_score')
                            ->paginate(self::PAGE_SIZE);

        return $topResult;
    }
    public function getSpecificRank(int $id) {
        $userRank = Rank::selectRaw("COUNT(*)+1 as rank")
                        ->whereRaw("current_score > (SELECT current_score 
                                        FROM ranks 
                                        WHERE user_id = {$id})")
                            ->get();
        return $userRank[0]->rank;
    }

}
