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
	public function updateUser($userId, request $request) {
		//Update Username and country in our user table

		$user = Player::find($userId);
		$newUserName=$request->name;
		$user->name = $newUserName;
		$user->save();


	}

	public function getUser($id, Request $numberOfUsers, $position){
		if ($id) return getSpecificUser($id);
		return getAllUsers($numberOfUsers, $position);
	}

	private function getAllUsers($numberOfUsers, $position) {
		// Get all users from a specific place (or the whole world in case of NULL)
		// for the ranking page

		$player = Player->find($id);
		return response()->json([
			"name" => $player->player_name,
			"position" => 1
		]);
	}


	private function getSpecificUser ($id) {
		//Get one user info for the user personal page
		

}
