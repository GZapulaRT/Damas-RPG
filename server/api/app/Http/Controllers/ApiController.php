<?php

namespace App\Http\Controllers;

use App\Models\Rank;
use App\Models\User;
use Illuminate\Http\Request;


class ApiController extends Controller
{
    public function oneUser($id){
        $user = User::getOneUser($id);
        return $user;
    }

    public function allUsers(int $page = 0){
        $users = User::getMultipleUsers($page);
        return $users;
    }

    public function topResults(int $page = 0){
        $top_results = Rank::getTopResults($page);
        return $top_results;
    }

    public function rank(){
        $user = User::find(1)->rank()->get();
        return $user;
    }
}
