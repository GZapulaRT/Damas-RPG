<?php

namespace App\Models;

use App\Jobs\ProcessRank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rank extends Model
{
    use HasFactory;
	protected $table = 'ranks';
	protected $fillable = ['current_score', 'user_id'];

    public $timestamps = false;

    public function scores(){
        return $this->hasMany(Score::class);
    }


}
