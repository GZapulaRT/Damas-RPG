<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Player;

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
	public function UpdateUser() {
		//Update Username and country in our user table

	}
 
	public function UpdateScoreData() {
		// Add a score record to our score table. Used to add all
		// score records to give us the user rank placement

	}

	public function UpdateStatus() {
		// Add a status record in our status table. Used to have a record
		// of penalizations of the user and the current state of their status.
		// Also have comments in case clarification is needed
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
