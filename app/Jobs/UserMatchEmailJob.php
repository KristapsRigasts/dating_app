<?php

namespace App\Jobs;

use App\Mail\MatchMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class UserMatchEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $userEmail;
    private $matchEmail;
    public $activeUserName;
    public $matchUserName;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userEmail, $activeUserName, $matchEmail, $matchUserName)
    {
        //
        $this->userEmail = $userEmail;
        $this->matchEmail = $matchEmail;

        $this->activeUserName = $activeUserName;
        $this->matchUserName = $matchUserName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->userEmail)->send(new MatchMail($this->matchUserName));

        Mail::to($this->matchEmail)->send(new MatchMail($this->activeUserName));
    }
}
