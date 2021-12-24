<?php


namespace App\Http\Controllers;


use App\Http\Requests\CommentRateRequest;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\CommentRate;
use App\Models\User;
use App\UseCases\CommentRateService;
use App\UseCases\CommentService;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private CommentService $service;
    private CommentRateService $rate_service;


    public function __construct(CommentService $service, CommentRateService $rate_service)
    {
        $this->service = $service;
        $this->rate_service = $rate_service;
    }

    public function stat(CommentRateRequest $form){
        if ($form['user_id'] == $form['author_id'])
            return abort(422, 'You can not rate your own comments');
        $stat = CommentRate::where([
            ['user_id', $form['user_id']],
            ['comment_id', $form['comment_id']],
        ])->first();

        if (isset($stat) > 0 and $stat->type !== $form['type'])
            return $this->rate_service->update($stat);

        if (isset($stat))
            return $this->rate_service->delete($stat);

        return $this->rate_service->create($form['type'], $form['user_id'], $form['comment_id']);
    }


    public function create(CommentRequest $form){
        try {
            $comment = $this->service->create($form);
            return [$comment, (User::where('id', $comment->user_id)->first())->name];
        }catch (\DomainException $e){
            return $e->getMessage();
        }
    }


    public function update(CommentRequest $form){
        try {
            $comment = Comment::where([
                ['user_id', $form['user_id']],
                ['id', $form['comment_id']]
            ])->first();
            return $this->service->update($comment, $form);
        }catch (\DomainException $e){
            return $e->getMessage();
        }
    }


    public function delete(Comment $comment){
        try {
            $this->service->delete($comment);
        }catch (\DomainException $e){
            return $e->getMessage();
        }
        return 'OK';
    }
}
