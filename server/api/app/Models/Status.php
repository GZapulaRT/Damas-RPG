<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
	protected $table = 'status';
	protected $fillable = ['player_id', 'status_current', 'status_comment', 'status_created_at'];

	public $timestamps = ['created_at'];
	const CREATED_AT = 'status_created_at';
	const UPDATED_AT = null;
}
