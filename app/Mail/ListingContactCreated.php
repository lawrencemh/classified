<?php

namespace App\Mail;

use App\Listing;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ListingContactCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The listing instance.
     *
     * @var \App\Listing
     */
    protected $listing;

    /**
     * The user instance.
     *
     * @var \App\User
     */
    protected $sender;

    /**
     * The message to be sent.
     *
     * @var string
     */
    protected $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Listing $listing, User $sender, $message)
    {
        $this->listing = $listing;
        $this->sender = $sender;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.listing.contact.message')
            ->subject("{$this->sender->name} sent a message about {$this->listing->title}")
            ->from('hello@classified.app')
            ->replyTo($this->sender->email)
            ->with('listing', $this->listing)
            ->with('sender', $this->sender)
            ->with('body', $this->message);
    }
}
