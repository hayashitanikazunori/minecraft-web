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

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->posts()->delete();
        });
    }

    public function updateUserFindById($id, $user)
    {
        /*************************************************
         * TODO
         * User/controllerにデータベースの処理を記述してるままなので、
         * モデルに処理を移す時にここの処理を使うこと。
         * 未検証なので、再調整は必須である。
        *************************************************/
        // return $this->find($id);
        return $this->where([
            'id' => $id['id']
        ]);
    }

    public function userFindById($id)
    {
        $user = User::findOrFail($id);
        return $user->delete();;
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
