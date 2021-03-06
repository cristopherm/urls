<?php

namespace App\Repositories;

use App\Models\TrackingLog;
use App\Models\Url;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Psr7\Header;
use Illuminate\Http\Client\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
        return Url::query()->paginate($page);
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
                Storage::deleteDirectory("pages/{$url->id}");

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
            $body = $this->convertToUtf8($response);

            DB::transaction(function () use ($url, $response, $body) {
                $log = TrackingLog::create([
                    'url_id' => $url->id,
                    'status_code' => $response->status(),
                ]);

                Storage::put("pages/{$url->id}/{$log->id}.html", $body);

                $url->last_status_code = $response->status();
                $url->last_verified_at = Carbon::now();
                $url->save();
            });
        } catch (Throwable $th) {
            Log::error($th);
        }
    }

    /**
     * Converts a string to UTF-8 enconding.
     *
     * @param Response $response
     * @return string
     */
    protected function convertToUtf8(Response $response): string
    {
        $type = $response->getHeader('content-type');
        $parsed = Header::parse($type);
        $originalBody = (string) $response->getBody();

        return mb_convert_encoding($originalBody, 'UTF-8', $parsed[0]['charset'] ?? 'UTF-8');
    }
}
