<?php

namespace App\Repositories\Interfaces;

use App\Models\Url;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Url repository interface.
 *
 * @package App\Repositories\Interfaces
 */
interface UrlRepositoryInterface
{
    /**
     * Get paginated urls.
     *
     * @param  int $page
     *
     * @return \Illuminate\Support\Collection|\Illuminate\Pagination\LengthAwarePaginator
     */
    public function get(int $page = 0): Collection|LengthAwarePaginator;

    /**
     * Get an url by its ID.
     *
     * @param  int $id
     *
     * @return \App\Models\Url
     */
    public function getById(int $id): Url;

    /**
     * Create a new url.
     *
     * @param  array $data
     *
     * @return \App\Models\Url
     */
    public function create(array $data): Url;

    /**
     * Update an existing url.
     *
     * @param  \App\Models\Url $url
     * @param  array $data
     *
     * @return \App\Models\Url
     */
    public function update(Url $url, array $data): Url;

    /**
     * Delete an url.
     *
     * @param  \App\Models\Url $url
     *
     * @return void
     */
    public function delete(Url $url): void;

    /**
     * Tracks an url.
     *
     * @param Url $url
     * @return void
     */
    public function trackUrl(Url $url): void;
}
