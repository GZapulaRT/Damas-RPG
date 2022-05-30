<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
	protected $table = 'scores';
	protected $fillable = ['user_id', 'change'];

    const UPDATED_AT = null;

    public Function rank(){
        return $this->hasOne(Rank::class);
    }

    public static function updateScore($user_id, $change){
        $score = self::create([
            'user_id' => $user_id,
            'change' => $change
        ]);

        Rank::updateRanks($score);
        return response()->json(['message: ' => 'Score added sucessfuly'], 201);
        //criar evento de atualizar rank
    }
}
