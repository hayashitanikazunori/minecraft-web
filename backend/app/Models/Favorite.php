<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function favoriteCreate($id)
    {
        $user_id = Auth::id();

        return Favorite::create([
            'post_id' => $id,
            'user_id' => $user_id,
        ]);
    }

    public function favoriteDelete($id)
    {
        $user_id = Auth::id();

        $favorite = Favorite::where('post_id', $id)->where('user_id', $user_id)->first();
        return $favorite->delete();
    }
}
