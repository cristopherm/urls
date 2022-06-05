<?php

namespace App\Console\Commands;

use App\Models\Url;
use App\Repositories\UrlRepository;
use Illuminate\Console\Command;

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
                (new UrlRepository())->trackUrl($url);
            }
        });
    }
}
