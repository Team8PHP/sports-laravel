<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class NewsSeeding implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $date = date('Y-m-d');
        $startDate= date('Y-m-d', strtotime('-30 days'));
        $page=1;
        $data = Http::withHeaders([
            'X-Api-Key' => 'c12781e9fcfa49678f88b6a79574bed0',
        ])->get('https://newsapi.org/v2/everything/?sources=four-four-two&from='.$startDate.'&to='.$date.'&page='.$page);

        $newData=json_decode($data);
        $articles=$newData->articles;
        seed_news($articles);
        $numOfPages=(int) ($newData->totalResults /100);
        if ($newData->totalResults % 100) {
            $numOfPages++;
        }
        if ($numOfPages>1) {
            for ($count=2; $count<=$numOfPages;$count++) {
                $data = Http::withHeaders([
                    'X-Api-Key' => 'c12781e9fcfa49678f88b6a79574bed0',
                ])->get('https://newsapi.org/v2/everything/?sources=four-four-two&from='.$startDate.'&to='.$date.'&page='.$count);
                $newData=json_decode($data);
                $articles=$newData->articles;
                seed_news($articles);
            }
        }
    }
}
