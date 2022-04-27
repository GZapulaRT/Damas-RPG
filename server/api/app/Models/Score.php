<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
	protected $table = 'score';
	protected $fillable = ['player_id', 'score_change', 'score_created_at'];

	public $timestamps = ['created_at'];
	const CREATED_AT = 'score_created_at';
	const UPDATED_AT = null;
}
