<?php

namespace App\Notifications;

use App\Models\Listing\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ListingAssigned extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private Listing $listing)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New listing!')
            ->line('You have been assigned a new listing!')
            ->line($this->listing->title)
            ->line($this->listing->description)
            ->line("Expected start date and time: {$this->listing->start->format('Y-m-d H:i')}")
            ->line("Expected end date and time: {$this->listing->end->format('Y-m-d H:i')}")
            ->line("Your contact name: {$this->listing->contact_name}")
            ->line("Your contact name: {$this->listing->contact_phone}")
            ->line("Your contact name: {$this->listing->contact_email}");
    }
}
