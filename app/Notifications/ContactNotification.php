<?php

namespace App\Notifications;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Class ContactNotification
 * @property Inquiry $inquiry
 * @package App\Notifications
 */
class ContactNotification extends Notification
{
    use Queueable;

    private $inquiry;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Inquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $records = [
            ['key' => __('validation.attributes.name'), 'value' => $this->inquiry->fromName],
            ['key' => __('validation.attributes.mobile'), 'value' => $this->inquiry->fromPhone],
            ['key' => __('validation.attributes.email'), 'value' => $this->inquiry->fromEmail],
        ];
        if ($this->inquiry->address != null) {
            array_push($records, (['key' => __('validation.attributes.address'), 'value' => $this->inquiry->address]));
        }
        if ($this->inquiry->job != null) {
            array_push($records, (['key' => __('validation.attributes.job'), 'value' => $this->inquiry->job]));
        }
        if ($this->inquiry->company != null) {
            array_push($records, (['key' => __('validation.attributes.company'), 'value' => $this->inquiry->company]));
        }

        return (new MailMessage)
            ->markdown('notifications.contact', ['records' => $records, 'message' => $this->inquiry->message])
            ->greeting(__('messages.hello') . ' ' . $this->inquiry->receiverName . ',')
            ->line(__($this->inquiry->includeAdmin ? 'messages.contact_admin_intro' : 'messages.contact_intro', [
                'user' => $this->inquiry->receiverName, 'email' => $this->inquiry->receiverEmail
            ]));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
        ];
    }
}
