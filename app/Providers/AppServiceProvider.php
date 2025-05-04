<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // メール確認通知のカスタマイズ
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('メールアドレスの確認をお願いします')
                ->line('ご登録ありがとうございます。以下のボタンをクリックして、メールアドレスの確認を行ってください。')
                ->action('メールアドレスを確認する', $url)
                ->line('この登録に心当たりがない場合は、このメッセージは無視していただいて構いません。');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
