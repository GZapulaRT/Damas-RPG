<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    private const PAGE_SIZE = 100;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'country_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rank(){
        return $this->hasOne(Rank::class);
    }

    public static function getOneUser($id){
        $user = self::find($id);
        if ($user === null){
            return response()->json(['message: ' => 'User not found', 404 ]);
        }
        return response()->json($user, 200);
    }

    public static function getMultipleUsers(int $page = 0){
        $offset = $page * self::PAGE_SIZE;

        $users = DB::table('users')
                        ->orderby('name')
                        ->offset($offset)
                        ->limit(self::PAGE_SIZE)
                        ->get();
       if ($users === null){
            return response()->json(['message: ' => 'Users not found', 404 ]);
        }
       return response()->json($users, 200);
    }
}
