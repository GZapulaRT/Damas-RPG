<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
	protected $table = 'status';
	protected $fillable = ['user_id', 'status', 'status'];


    function status(){
        return $this->hasOne(User::class);
    }

    function latestStatus($id){
        $this->find($id)->latest();
    }
}
