<?php

namespace Christoferd\Commentions\Actions;

use Christoferd\Commentions\Comment;
use Christoferd\Commentions\CommentReaction;
use Christoferd\Commentions\Config;
use Christoferd\Commentions\Contracts\Commenter;
use Christoferd\Commentions\Events\CommentWasReactedEvent;

class ToggleCommentReaction
{
    public static function run(Comment $comment, string $reaction, ?Commenter $user = null): void
    {
        if (! $user) {
            return;
        }

        if (! in_array($reaction, Config::getAllowedReactions())) {
            return;
        }

        /** @var CommentReaction $existingReaction */
        $existingReaction = $comment
            ->reactions()
            ->where('reactor_id', $user->getKey())
            ->where('reactor_type', $user->getMorphClass())
            ->where('reaction', $reaction)
            ->first();

        if ($existingReaction) {
            $existingReaction->delete();
        } else {
            $reaction = $comment->reactions()->create([
                'reactor_id' => $user->getKey(),
                'reactor_type' => $user->getMorphClass(),
                'reaction' => $reaction,
            ]);

            event(new CommentWasReactedEvent(
                comment: $comment,
                reaction: $reaction,
            ));
        }
    }
}
