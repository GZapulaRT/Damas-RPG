<?php
namespace App\Repository;

use App\Models\Status;

class StatusRepository
{
    function latestStatus($id){
        $latestScore = new Status();
        $latestScore = $latestScore->find($id)->latest();
        return $latestScore;
    }
}
