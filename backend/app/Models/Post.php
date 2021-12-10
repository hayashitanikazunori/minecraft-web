<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
        'user_id',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function postFindById($id)
    {
        return Post::findOrFail($id);
    }

    public function postDelete($id)
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

    public function postCreate($request)
    {
        $user_id = Auth::id();
        $image_path = $request['thumbnail_images']->store('public/thumbnail/');

        return Post::create([
            'title' => $request['title'],
            'thumbnail_images' => basename($image_path),
            'description' => $request['description'],
            'material' => $request['material'],
            'recipe' => $request['recipe'],
            'publicing_status' => 0,
            'user_id' => $user_id,
        ]);
    }

    public function postUpdate($request, $id)
    {
        $user_id = Auth::id();
        $image_path = $request['thumbnail_images']->store('public/thumbnail/');

        $post = Post::find($id);
        $post->title = $request['title'];
        $post->thumbnail_images = $request['thumbnail_images'];
        $post->description = $request['description'];
        $post->material = $request['material'];
        $post->publicing_status = 0;
        $post->user_id = $user_id;

        return $post->save();
    }
}
