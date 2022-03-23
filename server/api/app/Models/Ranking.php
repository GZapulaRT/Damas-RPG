<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    use HasFactory;
	protected $table = 'user';
	protected $fillable = ['user_id', 'user_name', 'country_code', 'user_creation_date'];
}

class Score extends Model
{
    use HasFactory;
	protected $table = 'score';
	protected $fillable = ['user_id', 'score_change', 'score_date'];
}
class Status extends Model
{
    use HasFactory;
	protected $table = 'status';
	protected $fillable = ['user_id', 'status_current', 'status_comment', 'status_date'];
}
