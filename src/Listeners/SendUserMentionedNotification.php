<?php

namespace Christoferd\Commentions\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use Christoferd\Commentions\Events\UserWasMentionedEvent;
use Christoferd\Commentions\Notifications\UserMentionedInComment;

class SendUserMentionedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(UserWasMentionedEvent $event): void
    {
        $user = $event->user;

        if (! config('christoferd-commentions.notifications.mentions.enabled', false)) {
            return;
        }

        $channels = (array) config('christoferd-commentions.notifications.mentions.channels', []);
        if (empty($channels)) {
            return;
        }

        $notificationClass = (string) config('christoferd-commentions.notifications.mentions.notification', UserMentionedInComment::class);
        $notification = app($notificationClass, ['comment' => $event->comment, 'channels' => $channels]);

        Notification::send($user, $notification);
    }
}
