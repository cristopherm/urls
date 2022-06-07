<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Concerns\ResetsPage;
use App\Models\TrackingLog;
use App\Models\Url;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class ShowLogs extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use ResetsPage;

    const PER_PAGE = 10;

    /**
     * Url instance.
     *
     * @var \App\Models\Url
     */
    public $url;

    /**
     * Mount the component data.
     *
     * @param Url $url
     * @return void
     */
    public function mount(Url $url)
    {
        $this->url = $url;
    }

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.show-logs', [
            'logs' => TrackingLog::query()
                ->where('url_id', $this->url->id)
                ->orderBy('created_at', 'desc')
                ->paginate(self::PER_PAGE),
        ]);
    }
}
