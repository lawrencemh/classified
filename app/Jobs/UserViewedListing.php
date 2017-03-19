<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\User;
use App\Listing;

class UserViewedListing implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Hold the user instance.
     *
     * @var \App\User
     */
    public $user;

    /**
     * Hold the listing instance.
     *
     * @var \App\Listing
     */
    public $listing;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Listing $listing)
    {
        $this->user = $user;
        $this->listing = $listing;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // get current viewed listings
        $viewed = $this->user->viewedListings;

        if ($viewed->contains($this->listing)) {
            // increment count on current relation
            $viewed->where('id', $this->listing->id)
                ->first()
                ->pivot
                ->increment('count');
        } else {
            // insert initial relation
            $this->user->viewedListings()->attach($this->listing, 
                ['count' => 1]
            );
        }
    }
    
}
