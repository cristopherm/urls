<?php

namespace App\Http\Livewire;

use App\Models\Url;
use App\Repositories\UrlRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUrls extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    const PER_PAGE = 10;

    protected $paginationTheme = 'bootstrap';

    /**
     * Url repository.
     *
     * @var UrlRepository
     */
    protected $urlRepository;

    public function __construct()
    {
        $this->urlRepository = new UrlRepository();
    }

    /**
     * Renders the component.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function render()
    {
        return view('livewire.show-urls', [
            'urls' => $this->urlRepository->get(self::PER_PAGE),
        ]);
    }

    /**
     * Resets the page.
     */
    public function onResetPage()
    {
        $this->resetPage();
    }
}
