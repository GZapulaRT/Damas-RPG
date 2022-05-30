<?php

namespace App\Jobs;

use App\Models\Rank;
use App\Models\Score;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProcessRank implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $score;
    private $user_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Score $score) {
        $this->score = $score->change;
        $this->user_id = $score->user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return DB::table('ranks')->where('user_id', $this->user_id)->increment('current_score', $this->score);
    }
}
