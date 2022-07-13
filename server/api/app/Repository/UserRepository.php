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
                    ->select('users.name', 'users.image', 'users.description','countries.name as country', 'users.email', 'users.created_at', 'users.updated_at')
                    ->orderBy('users.name')
                    ->where('users.id', '=',$id)
                    ->get();
        $user = $user[0];
        return $user;
    }

    public function getMultipleUsers(){
        $users = DB::table('users')
                    ->join('countries', 'users.country_id', 'countries.id')
                    ->select('users.id', 'users.name', 'users.image','users.description','countries.name')
                    ->orderBy('users.name')
                    ->paginate(self::PAGE_SIZE);
        return $users;
    }

public function store(Request $request): void {
        $image = null;
        if ($request->hasFile("image")){
            $image = $request->file('image')->store('users');
        }
        $this->user::create([
            "name" => $request->name,
            "image" => $image,
            "country_id" => $request->country_id,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);
    }

    public function update(Request $request): void {
        $this->user::WhereId($request->id)->update([
            "name" => $request->name,
            "email" => $request->email,
            "description" => $request->description
        ]);
		if ($request->image){
			$image = $this->user::find($request->id)->select('image')->get();
			Storage::delete($image);

			$this->user::whereId($request->id)->update([
					'image' => $request->file('image')->store('users')
				]);
		}
    }

    public function updateOnlyImage(Request $request):void {
        $image = null;
        if ($request->hasFile('image')){
            $image = $request->file('image')->store('users');
        }

        $old_image = $this->user::WhereId($request->id)->select('image')->get();
        Storage::delete($old_image);

        $this->user::WhereId($request->id)->update([
            "image" => $image
        ]);
    }
}
