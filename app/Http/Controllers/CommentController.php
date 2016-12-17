<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Repositories\CommentRepository;
use App\Http\Repositories\PostRepository;
use App\Http\Requests;
use Gate;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentRepository;
    protected $postRepository;

    public function __construct(CommentRepository $commentRepository, PostRepository $postRepository)
    {
        $this->commentRepository = $commentRepository;
        $this->postRepository = $postRepository;
        $this->middleware('auth', ['except' => ['show', 'store']]);
    }

    public function edit(Comment $comment)
    {
        return view('comment.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $this->checkPolicy('manager', $comment);

        if ($this->commentRepository->update($request->get('content'), $comment)) {
            $redirect = request('redirect');
            if ($redirect)
                return redirect($redirect)->with('success', trans('xblog.saved'));
            return back()->with('success', trans('xblog.saved'));
        }
        return back()->withErrors(trans('xblog.not_saved'));
    }


    public function store(Request $request)
    {
        if (!$request->get('content')) {
            return response()->json(
                ['status' => 500, 'msg' => trans('xblog.comment_cant_be_empty')]
            );
        }
        if (!auth()->check()) {
            if (!($request->get('username') && $request->get('email'))) {
                return response()->json(
                    ['status' => 500, 'msg' => trans('xblog.username_cant_be_empty')]
                );
            }
            $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
            if (!preg_match( $pattern, request('email') )) {
                return response()->json(
                    ['status' => 500, 'msg' => trans('xblog.invalid_email')]
                );
            }
        }

        if ($comment = $this->commentRepository->create($request))
            return response()->json(['status' => 200, 'msg' => 'success']);
        return response()->json(['status' => 500, 'msg' => trans('auth.failed')]);
    }


    public function show(Request $request, $commentable_id)
    {
        $commentable_type = $request->get('commentable_type');
        $comments = $this->commentRepository->getByCommentable($commentable_type, $commentable_id);
        $redirect = $request->get('redirect');
        return view('comment.show', compact('comments', 'commentable', 'redirect'));
    }

    public function restore($comment_id)
    {
        $comment = Comment::withTrashed()->findOrFail($comment_id);

        $this->checkPolicy('restore', $comment);

        if ($comment->trashed()) {
            $comment->restore();
            $this->commentRepository->clearAllCache();
            return redirect()->route('admin.comments')->with('success', trans('xblog.saved'));
        }
        return redirect()->route('admin.comments')->withErrors(trans('xblog.not_saved'));
    }


    public function destroy($comment_id)
    {
        if (request('force') == 'true') {
            $comment = Comment::withTrashed()->findOrFail($comment_id);
        } else {
            $comment = Comment::findOrFail($comment_id);
        }

        $this->checkPolicy('manager', $comment);

        if ($this->commentRepository->delete($comment, request('force') == 'true')) {
            return back()->with('success', trans('xblog.saved'));
        }
        return back()->withErrors(trans('xblog.not_saved'));
    }
}
