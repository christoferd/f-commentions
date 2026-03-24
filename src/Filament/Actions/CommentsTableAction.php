<?php

namespace Christoferd\Commentions\Filament\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Christoferd\Commentions\Filament\Concerns\HasMentionables;
use Christoferd\Commentions\Filament\Concerns\HasPolling;
use Christoferd\Commentions\Filament\Concerns\HasSidebar;
use Christoferd\Commentions\Filament\Concerns\HasTipTapCssClasses;

class CommentsTableAction extends Action
{
    use HasMentionables;
    use HasPolling;
    use HasSidebar;
    use HasTipTapCssClasses;

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->icon('heroicon-o-chat-bubble-left-right')
            ->modalContent(fn (Model $record) => view('commentions::comments-modal', [
                'record' => $record,
                'mentionables' => $this->getMentionables(),
                'pollingInterval' => $this->getPollingInterval(),
                'sidebarEnabled' => $this->isSidebarEnabled(),
                'showSubscribers' => $this->showSubscribers(),
                'tipTapCssClasses' => $this->getTipTapCssClasses(),
            ]))
            ->modalWidth($this->isSidebarEnabled() ? '4xl' : 'xl')
            ->label(__('commentions::comments.label'))
            ->modalSubmitAction(false)
            ->modalCancelAction(false)
            ->modalAutofocus(false);
    }

    public static function getDefaultName(): ?string
    {
        return 'commentList';
    }
}
