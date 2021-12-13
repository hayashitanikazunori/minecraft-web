<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'body',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentCreate($request, $id)
    {
        $user_id = Auth::id();

        return Comment::create([
            'user_id' => $user_id,
            'post_id' => $id,
            'body' => $request['body'],
        ]);
    }

    public function commentUpdate($request, $id)
    {
        $comment = Comment::findOrFail($id);

        if (Auth::id() == $comment->id) {
            $comment->body = $request['body'];
            $comment->save();
            $json = "コメントの変更に成功しました。";
            return $json;
        }else {
            $json = "許可されていない操作です。";
            return $json;
        }
    }

    public function commentDelete($id)
    {
        $comment = Comment::findOrFail($id);
        if (Auth::id() === $comment->user_id) {
            $comment->delete();
            $json = "削除に成功しました。";
            return $json;
        }else {
            $json = "許可されていない操作です。";
            return $json;
        }
    }

    public function CommentGetsById($id)
    {
        $post = Post::findOrFail($id);

        return Comment::where('post_id', $post->id)->get();
    }
}
