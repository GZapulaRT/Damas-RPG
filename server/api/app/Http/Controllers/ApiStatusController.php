

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{Player, Status, Score};


class ApiStatusController extends Controller
{

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

	/* //if people want to implement in the future */
	/* public function GetAllStatusRecord ($id){ */
	/* 	//users history of status changes */
	/* } */
}
