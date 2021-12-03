<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'thumbnail_images',
        'description',
        'material',
        'recipe',
        'publicing_status',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function ($user) {
    //         $user->posts()->delete();
    //     });
    // }

    public function postFindById($id)
    {
        $post = Post::findOrFail($id);
        return $post->delete();
    }

    public function changepPublicingStatus($id)
    {
        $post = Post::findOrFail($id);

        if ($post->publicing_status == 0) {
            $post->publicing_status = 1;
            return $post->save();
        }else {
            $post->publicing_status = 0;
            return $post->save();
        }
    }

}
