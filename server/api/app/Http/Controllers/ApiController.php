<?php

namespace App\Http\Controllers;

use App\Models\{User,Rank, Score};
use App\Repository\RankRepository;
use App\Repository\ScoreRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;


class ApiController extends Controller
{
    public function oneUser($id){
        $user = new User;
        $user = new UserRepository($user);
        $user = $user->getOneUser($id);

        $user_rank = new RankRepository;
        $user_rank = $user_rank->getSpecificRank($id);

        if ($user->isEmpty()){
            return response()->json(['message: ' => 'User not found'], 404);
        }
        return response()->json([
            "id" => $id,
            "name" => $user->name,
            "image" => $user->image,
            "country" => $user->country,
            "description" => $user->description,
            "created_at" => $user->created_at,
            "updated_at" => $user->updated_at,
            "rank" => $user_rank
        ], 200);
    }

    public function allUsers(){
        $user = new User;
        $all_users = new UserRepository($user);
        $all_users = $all_users->getMultipleUsers();
        if ($all_users->isEmpty()){
            return response()->json(['message: ' => 'Users not found'], 404);
        }
        return response()->json($all_users, 200);
    }

    public function updateScore(Request $request){
        return;
    }

    public function topResults(){
        $top_results = new RankRepository();
        $top_results = $top_results->getTopResults();
        if ($top_results->isEmpty()){
            return response()->json(["Message: " => 'Users not found'], 404);
        }
        return response()->json($top_results, 200);
    }

    public function userRank(int $id) {
        $user_rank = new RankRepository;
        $user_rank = $user_rank->getSpecificRank($id);
        return $user_rank;
    }

    public function storeUser(Request $request) {
        $user = new UserRepository(new User);
        $user = $user->store($request);
        return response()->json(["Message" => "User added sucessfully"], 201);
    }

    public function storeScore(Request $request) {
        $score = new ScoreRepository(new Score);
        $score->store($request);
        return response()->json(['Message: ' => 'Score added sucessfully'], 201);
    }

}
