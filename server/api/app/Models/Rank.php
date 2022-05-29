<?php

namespace App\Models;

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

    public static function getTopResults(int $page=0){
        $offset = $page * self::PAGE_SIZE;
        $top_results = DB::table('ranks')
                            ->join('users', 'users.id', '=', 'ranks.user_id')
                            ->join('countries', 'users.country_id', '=', 'countries.id')
                            ->select('ranks.current_score', 'users.name', 'countries.name as country')
                            ->orderByDesc('current_score')
                            ->offset($offset)
                            ->limit(self::PAGE_SIZE)
                            ->get();

        return response()->json($top_results, 200);
    }
}
