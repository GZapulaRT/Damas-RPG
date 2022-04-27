<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
	protected $table = 'player';
	protected $fillable = ['player_name', 'country_id'];

	const CREATED_AT = 'player_created_at';
	const UPDATED_AT = 'player_updated_at';
}


