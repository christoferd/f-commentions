<?php

namespace Christoferd\Commentions\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Christoferd\Commentions\Comment;
use Christoferd\Commentions\CommentReaction;

class CommentWasReactedEvent
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(
        public Comment $comment,
        public CommentReaction $reaction,
    ) {}
}
