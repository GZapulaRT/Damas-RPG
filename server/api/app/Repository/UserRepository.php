<?php
namespace App\Repository;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserRepository{

    private User $user;
    private const PAGE_SIZE = 100;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function getOneUser(int $id) {
        $user = DB::table('users')
                    ->join('countries', 'users.country_id','=', 'countries.id')
                    ->select('users.id', 'users.name', 'users.image', 'users.description','countries.name', 'users.email', 'users.created_at', 'users.updated_at')
                    ->orderBy('users.name')
                    ->where('users.id', '=',$id)
                    ->get();
        if ($user->isEmpty()){
            return response()->json(['message: ' => 'User not found'], 404);
        }
        return response()->json($user, 200);
    }

    public function getMultipleUsers(){
        $users = DB::table('users')
                    ->join('countries', 'users.country_id', 'countries.id')
                    ->select('users.id', 'users.name', 'users.image','users.description','countries.name', 'users.email', 'users.created_at', 'users.updated_at')
                    ->orderBy('users.name')
                    ->paginate(self::PAGE_SIZE);

        if ($users->isEmpty()){
            return response()->json(['message: ' => 'Users not found'], 404);
        }
        return response()->json($users, 200);
    }

    public function store(Request $request): void {
        $image = null;
        if ($request->hasFile("image")){
            $image = $request->file('image')->store('users');
        }
        User::create([
            "name" => $request->name,
            "image" => $image,
            "country_id" => $request->country_id,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);
    }

    public function update(Request $request): void {
        User::WhereId($request->id)->update([
            "name" => $request->name,
            "email" => $request->email,
            "description" => $request->description
        ]);
		if ($request->image){
			$image = User::find($request->id)->select('image')->get();
			Storage::delete($image);

			User::whereId($request->id)->update([
					'image' => $request->file('image')->store('users')
				]);
		}
    }

    public function updateOnlyImage(Request $request):void {
        $image = null;
        if ($request->hasFile('image')){
            $image = $request->file('image')->store('users');
        }

        $old_image = User::WhereId($request->id)->select('image')->get();
        Storage::delete($old_image);

        User::WhereId($request->id)->update([
            "image" => $image
        ]);
    }
}
