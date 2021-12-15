<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_image',
        'profile',
        'freezing_status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->posts()->delete();
        });
    }

    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function userFreezingStatusFindByEmail($email)
    {
        $user = User::where('email', $email)->first();
        return $user->freezing_status;
    }

    public function userCreatedCheck($email)
    {
        return User::where('email', $email)->count();
    }

    public function userCreate($request)
    {
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'avatar_image' => null,
            'profile' => null,
            'freezing_status' => 0,
        ]);
    }

    public function userUpdate($request,  $id)
    {
        function avatarImageCheck($request)
        {
            if ($request == true) {
            $image_path = $request->store('public/avatar/');
            return basename($image_path);
            }else {
                return '';
            }
        }

        $user = User::findOrFail($id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->avatar_image = avatarImageCheck($request['avatar_image']);
        $user->profile = $request['profile'];

        return $user->save();
    }

    public function userDelete($id)
    {
        $user = User::find($id);
        return $user->delete();
    }

    public function changeFreezingStatus($id)
    {
        $user = User::findOrFail($id);

        if ($user->freezing_status == 0) {
            $user->freezing_status = 1;
            return $user->save();
        }else {
            $user->freezing_status = 0;
            return $user->save();
        }
    }
}
