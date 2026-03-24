<?php

namespace Christoferd\Commentions\Filament\Infolists\Components;

use Filament\Infolists\Components\Entry;
use Christoferd\Commentions\Filament\Concerns\HasMentionables;
use Christoferd\Commentions\Filament\Concerns\HasPagination;
use Christoferd\Commentions\Filament\Concerns\HasPolling;
use Christoferd\Commentions\Filament\Concerns\HasSidebar;
use Christoferd\Commentions\Filament\Concerns\HasTipTapCssClasses;

class CommentsEntry extends Entry
{
    use HasMentionables;
    use HasPagination;
    use HasPolling;
    use HasSidebar;
    use HasTipTapCssClasses;

    protected string $view = 'commentions::filament.infolists.components.comments-entry';
}
