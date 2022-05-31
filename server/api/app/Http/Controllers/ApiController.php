<?php

namespace App\Http\Controllers;

use App\Models\{User,Rank, Score};
use Illuminate\Http\Request;


class ApiController extends Controller
{
    public function oneUser($id){
        $user = User::getOneUser($id);
        return $user;
    }

    public function allUsers(){
        $users = User::getMultipleUsers();
        return $users;
    }

    public function updateScore(Request $request){
        $user_id = $request->user_id;
        $change = $request->change;
        $response = Score::updateScore($user_id, $change);
        return $response;
    }

    public function topResults(){
        $top_results = Rank::getTopResults();
        return $top_results;
    }

    public function rank(){
        $user = User::find(1)->rank()->get();
        return $user;
    }
}
