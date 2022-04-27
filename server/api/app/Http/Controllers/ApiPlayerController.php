<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{Player, Status, Score};


class ApiPlayerController extends Controller
{
	public function addPlayer(request $request) {
		// Add a new user to our user table
		$player = Player::create([
			'player_name' => $request->player_name,
			'country_id' => $request->country_id
		]);

		return response()->json([
			"message" => "Seja bem vindo {$player->player_name}"
		], 201);
 

	}
	public function UpdateUser($userId, request $request) {
		//Update Username and country in our user table

		$user = Player::find($userId);
		$newUserName=$request->name;
		$user->name = $newUserName;
		$user->save();


	}

	public function GetAllUsers($place, $numberOfUsers) {
		// Get all users from a specific place (or the whole world in case of NULL)
		// for the ranking page
	}

	public function GetSpecificUser ($id) {
		//Get one user info for the user personal page
	}

}
