<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
	protected $table = 'user';
	protected $fillable = ['user_name', 'country_code'];
	const CREATED_AT = 'user_created_at';
	const UPDATED_AT = null;
}

class Score extends Model
{
    use HasFactory;
	protected $table = 'score';
	protected $fillable = ['user_id', 'score_change', 'score_date'];
	const CREATED_AT = 'score_date';
	const UPDATED_AT = null;
}
class Status extends Model
{
    use HasFactory;
	protected $table = 'status';
	protected $fillable = ['user_id', 'status_current', 'status_comment', 'status_date'];
	const CREATED_AT = 'status_date';
	const UPDATED_AT = null;
}
