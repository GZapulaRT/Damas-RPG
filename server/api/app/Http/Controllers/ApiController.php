<?php

namespace App\Http\Controllers;

use App\Models\{User,Rank, Score};
use App\Repository\RankRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;


class ApiController extends Controller
{
    public function oneUser($id){
        $user = new User;
        $allusers = new UserRepository($user);
        $allusers = $allusers->getOneUser($id);
        return $allusers;
    }

    public function allUsers(){
        $user = new User;
        $users = new UserRepository($user);
        $users = $users->getMultipleUsers();
        return $users;
    }

    public function updateScore(Request $request){
        $user_id = $request->user_id;
        $change = $request->change;
        $response = Score::updateScore($user_id, $change);
        return $response;
    }

    public function topResults(){
        $top_results = new RankRepository();
        $top_results = $top_results->getTopResults();
        return $top_results;
    }

    public function rank(){
        $user = User::find(1)->rank()->get();
        return $user;
    }

    public function userRank(int $id) {
        $user_rank = new RankRepository;
        $user_rank = $user_rank->getSpecificRank($id);
        return $user_rank;
    }

}
