<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
	protected $table = 'status';
	protected $fillable = ['user_id', 'status_current', 'status_comment', 'status_date'];
	const CREATED_AT = 'status_date';
	const UPDATED_AT = null;
}
