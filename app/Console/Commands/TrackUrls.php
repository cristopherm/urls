<?php

namespace App\Console\Commands;

use App\Models\TrackingLog;
use App\Models\Url;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TrackUrls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:trackurls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Url::chunk(10, function ($urls) {
            foreach ($urls as $url) {
                $response = Http::get($url->address);

                TrackingLog::create([
                    'url_id' => $url->id,
                    'status_code' => $response->status(),
                    'body' => $response->body(),
                ]);
            }
        });
    }
}
