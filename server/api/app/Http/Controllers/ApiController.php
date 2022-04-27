<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{Player, Status, Score};


class ApiController extends Controller
{
	public function AddUser(request $request) {
		// Add a new user to our user table
		$user = new Player;
	    $user->user_name = $request->user_name;	
		$user->country_code = $request->country_code;
		$user->save();

		return response()->json([
			"message" => "essa bagaça funciona por Magica(\$seiLáOq)"
		], 201);
 

	}
	public function UpdateUser($userId, request $request) {
		//Update Username and country in our user table

		$user = Player::find($userId);
		$newUserName=$request->name;
		$user->name = $newUserName;
		$user->save();


	}
 
	public function UpdateScoreData(request $request) {
		// Add a score record to our score table. Used to add all
		// score records to give us the user rank placement
		$score = new Score;
		$score->user_id = $request->user_id;
		$score->score_change = $request->score_change;
		$score->save();
		
		return response()->json([
			"message" => "essa bagaça funciona por Magica(\$seiLáOq)"
		], 201);

	}

	public function UpdateStatus(request $request) {
		// Add a status record in our status table. Used to have a record
		// of penalizations of the user and the current state of their status.
		// Also have comments in case clarification is needed
		$status = new Status;
		$status->user_id = $request->user_id;
		$status->status_change = $request->status_change;
		$status->status_comment = $request->status_comment;
		$status->save();

		return response()->json([
			"message" => "essa bagaça funciona por Magica(\$seiLáOq)"
		], 201);
	}

	public function GetAllUsers($place, $numberOfUsers) {
		// Get all users from a specific place (or the whole world in case of NULL)
		// for the ranking page
	}

	public function GetSpecificUser ($id) {
		//Get one user info for the user personal page
	}

	/* //if people want to implement in the future */
	/* public function GetAllStatusRecord ($id){ */
	/* 	//users history of status changes */
	/* } */
}
