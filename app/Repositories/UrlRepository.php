<?php

namespace App\Repositories;

use App\Models\TrackingLog;
use App\Models\Url;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Url repository class.
 *
 * @package App\Repositories
 */
class UrlRepository implements Interfaces\UrlRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function get(int $page = 0): Collection|LengthAwarePaginator
    {
        return Url::query()->paginate(page: $page);
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id): Url
    {
        /** @var \App\Models\Url $url */
        $url = Url::query()->findOrFail($id);

        return $url;
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function create(array $data): Url
    {
        try {
            return DB::transaction(function () use ($data) {
                $url = new Url($data);
                $url->save();

                return $url;
            });
        } catch (Throwable $th) {
            Log::error($th);
            throw new Exception(__('general.unknown_error'));
        }
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function update(Url $url, array $data): Url
    {
        try {
            $url->update($data);

            return $url;
        } catch (Throwable $th) {
            Log::error($th);
            throw new Exception(__('general.unknown_error'));
        }
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function delete(Url $url): void
    {
        try {
            DB::transaction(function () use ($url) {
                $url->delete();
            });
        } catch (Throwable $th) {
            Log::error($th);
            throw new Exception(__('general.unknown_error'));
        }
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function trackUrl(Url $url): void
    {
        try {
            $response = Http::send('GET', $url->address, ['headers' => ['Accept-Language' => 'pt']]);

            DB::transaction(function () use ($url, $response) {
                TrackingLog::create([
                    'url_id' => $url->id,
                    'status_code' => $response->status(),
                    'body' => utf8_encode($response->body()),
                ]);
            });
        } catch (Throwable $th) {
            Log::error($th);
        }
    }
}
