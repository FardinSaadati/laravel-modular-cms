<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use NotificationChannelsPlus\Telegrambot\TelegramChannel;
use NotificationChannelsPlus\Telegrambot\TelegramMessage;
use Illuminate\Notifications\Notification;


class PostPublished extends Notification
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


//        $id             = '@oiltalent_ir';
//        $companyImage   = 'http://up.vbiran.ir/uploads/18621150432882226546_join-channel-1.png';
//        $nameBtn        = 'Register';
//        $urlBtn         = 'https://oiltalent.ir/candidate/join';
//        $caption        = "برای عضویت روی لینک زیر کلیک کنید";
//        $caption        .= "\n";
//        $caption        .= "https://oiltalent.ir/candidate/join";

//        TelegramMessage::create()
//            ->to($id)
//            ->sendPhoto([
//                'caption'   =>  $caption,
//                'photo'     =>  $image
//            ])
//            ->button($nameBtn, $urlBtn);
//
//        return session('resultTg');


        $user       = $post->user;
        $company    = $user->company;


        $url = 'https://oiltalent.ir/';
        $jobDetail = $url . 'candidate/jobDetail/' . $post->ad_number;

        $jobCategories = [];
        foreach ($post->jobCategories as $category)
            $jobCategories[] = $category->title;


        $companyImage       = $url . 'employer/custom/no-logo.jpg';
        if($company->img_approve == 'y' AND !empty($company->img))
            $companyImage   = $url . 'uploads/employers/company-logos/' . $company->img;


        $caption    = '';
        $caption    .= "Job Title: " . $post->position . "\n";
        $caption    .= "Company: " . $company->title . "\n";
        $caption    .= "Job Location: " . getNameCountry($post->country) . " / " . $post->city . "\n";
        $caption    .= "Job Type: ". ucfirst($post->job_type) ." / " . ucfirst($post->job_type_2) . "\n";

        if(!empty($jobCategories) AND count($jobCategories))
            $caption    .= "Job Category: " . implode(', ', $jobCategories) . "\n";

        $caption    .= "\n@OilTalent";


        $tg = TelegramMessage::create()
                ->to('@oiltalent_ir')
                ->sendPhoto([
                    'caption'   =>  $caption,
                    'photo'     =>  $companyImage
                ])
                ->button('View Job', $jobDetail);

        return $tg;
    }
}
