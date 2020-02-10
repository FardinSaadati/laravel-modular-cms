<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;

use NotificationChannelsPlus\Telegrambot\TelegramChannel;
use NotificationChannelsPlus\Telegrambot\TelegramMessage;
use Illuminate\Notifications\Notification;


class TelegramPublished extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', 'https://laravel.com')
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }



    public function toTelegram($post)
    {
//        $id         = \request('id');
//        $image      = \request('image');
//        $nameBtn    = \request('nameBtn');
//        $urlBtn     = \request('urlBtn');
//        $caption    = \request('caption');

//        $id         = '@oiltalent_ir';
//        $image      = 'http://up.vbiran.ir/uploads/18621150432882226546_join-channel-1.png';
//        $nameBtn    = 'Register';
//        $urlBtn     = 'https://oiltalent.ir/candidate/join';
//        $caption    = '';
//
//        TelegramMessage::create()
//                ->to($id)
//                ->sendPhoto([
//                    'caption'   =>  $caption,
//                    'photo'     =>  $image
//                ])
//                ->button($nameBtn, $urlBtn);
//
//        return session('resultTg');
    }
}
