<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentScore extends Model
{
    use HasFactory;
	protected $table = 'rank';
	protected $fillable = ['rank_current_score'];

	public $timestamps = false;

	public function player_name($id){
		$player = Player::find($id);
		return $player->name;
	}
}
