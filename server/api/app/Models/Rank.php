<?php

namespace App\Models;

use App\Jobs\ProcessRank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rank extends Model
{
    use HasFactory;
	protected $table = 'ranks';
	protected $fillable = ['current_score', 'user_id'];

    public $timestamps = false;

    public const PAGE_SIZE = 100;

    public function scores(){
        return $this->hasMany(Score::class);
    }

    public static function updateRanks(Score $score) :void {
        $queue = new ProcessRank($score);
        $queue->dispatch($score);
    }

    public static function getTopResults(){
        $top_results = DB::table('ranks')
                            ->join('users', 'users.id', '=', 'ranks.user_id')
                            ->join('countries', 'users.country_id', '=', 'countries.id')
                            ->select('ranks.current_score', 'users.name', 'countries.name as country')
                            ->orderByDesc('current_score')
                            ->paginate(self::PAGE_SIZE);

        return response()->json($top_results, 200);
    }
}
