<?php

namespace App\Notifications;

use App\Models\Listing\Listing;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ListingUpdated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private readonly Listing $listing)
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
            ->subject('Listing Updated!')
            ->line('This listing has been updated!')
            ->line($this->listing->title)
            ->line($this->listing->description)
            ->line("Expected start date and time: {$this->listing->start->format('Y-m-d H:i')}")
            ->line("Expected end date and time: {$this->listing->end->format('Y-m-d H:i')}")
            ->line("Your contact name: {$this->listing->contact_name}")
            ->line("Your contact name: {$this->listing->contact_phone}")
            ->line("Your contact name: {$this->listing->contact_email}");
    }
}
