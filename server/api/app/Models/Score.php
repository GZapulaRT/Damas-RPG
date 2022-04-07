<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
	protected $table = 'score';
	protected $fillable = ['user_id', 'score_change', 'score_date'];
	const CREATED_AT = 'score_date';
	const UPDATED_AT = null;
}
