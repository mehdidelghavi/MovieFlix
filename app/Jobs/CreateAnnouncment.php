<?php

namespace App\Jobs;

use App\Models\Announcements;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class CreateAnnouncment implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public $user_id,public $subject_id, public $subject_type, public $message)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (is_array($this->user_id )){
            foreach ($this->user_id as $key => $value){
                $createAnnouncement = Announcements::create([
                    'user_id' => $value,
                    'subject_id' => $this->subject_id,
                    'subject_type' => $this->subject_type,
                    'message' => $this->message
                ]);
            }
        } else {
            $createAnnouncement = Announcements::create([
                'user_id' => $this->user_id,
                'subject_id' => $this->subject_id,
                'subject_type' => $this->subject_type,
                'message' => $this->message
            ]);
        }
    }
}
