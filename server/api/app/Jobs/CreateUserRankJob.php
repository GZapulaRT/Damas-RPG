<?php

namespace App\Jobs;

use App\Models\Rank;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateUserRankJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user_id;
    private $current_score=0;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user) {
        $this->user_id = $user->id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return Rank::create([
            "user_id" => $this->user_id,
            "current_score" => $this->current_score,
        ]);
    }
}

