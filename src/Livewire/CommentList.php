<?php

namespace Christoferd\Commentions\Livewire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Christoferd\Commentions\Livewire\Concerns\HasMentions;
use Christoferd\Commentions\Livewire\Concerns\HasPagination;
use Christoferd\Commentions\Livewire\Concerns\HasPolling;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class CommentList extends Component
{
    use HasMentions;
    use HasPagination;
    use HasPolling;

    public Model $record;

    public ?string $tipTapCssClasses = null;

    public function render()
    {
        return view('commentions::comment-list');
    }

    #[Computed]
    public function comments(): Collection
    {
        return $this->record->getComments($this->paginate ? $this->perPage : null);
    }

    #[On('comment:saved')]
    #[On('comment:updated')]
    #[On('comment:deleted')]
    public function reloadComments(): void
    {
        unset($this->comments);
    }
}
