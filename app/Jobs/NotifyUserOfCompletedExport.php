<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\AdmissionsExportReady;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyUserOfCompletedExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    
    protected $user;

    protected $filePath;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $filePath)
    {
        $this->user = $user;

        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        $this->user->notify(new AdmissionsExportReady($this->filePath));

    }
}
