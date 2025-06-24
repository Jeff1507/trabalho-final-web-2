<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function reportedComments() {
        $this->authorize('hasModeratePermission', Comment::class);
        $comments = Comment::with(['review.user'])->where('isReported', true)->get();
        return view('comments.reported-comments')->with(['comments'=>$comments]);
    }
    public function reportComment(string $id) {
        $this->authorize('hasReportPermission', Comment::class);
        $comment = Comment::findOrFail($id);
        if ($comment->isReported == false) {
            $comment->isReported = true;
            $comment->save();
        }

        return back()->with('success', 'Denúncia enviada para a moderação!');
    }

    public function removeComment(string $id) {
        $this->authorize('hasModeratePermission', Comment::class);
        $comment = Comment::findOrFail($id);
        $comment->isRemoved = true;
        $comment->isReported = false;
        $comment->save();

        return back()->with('success', 'Comentário removido!');
    }
}
