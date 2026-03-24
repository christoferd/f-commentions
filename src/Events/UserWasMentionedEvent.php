<?php

namespace Christoferd\Commentions\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Christoferd\Commentions\Comment;
use Christoferd\Commentions\Contracts\Commenter;

class UserWasMentionedEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public readonly Comment $comment;

    public readonly Commenter $user;

    public function __construct($comment, $user)
    {
        $this->comment = $comment;
        $this->user = $user;
    }
}
