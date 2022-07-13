<?php
namespace App\Repository;

use App\Models\Score;

class StatusRepository 
{
    function latestStatus($id){
        $lastestScore = new Score;
        $lastestScore = $lastestScore->find($id)->latest();
        return $lastestScore;
    }
}
