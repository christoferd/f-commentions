<?php

namespace Tests\Policies;

use Christoferd\Commentions\Comment;
use Christoferd\Commentions\Contracts\Commenter;
use Christoferd\Commentions\Policies\CommentPolicy;

class BlockedCommentPolicy extends CommentPolicy
{
    public function create(Commenter $user): bool
    {
        return false;
    }

    public function update($user, Comment $comment): bool
    {
        return false;
    }

    public function delete($user, Comment $comment): bool
    {
        return false;
    }
}
