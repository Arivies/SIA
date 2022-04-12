<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use \Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Support\Facades\Lang;

class ResetPassword extends ResetPasswordNotification //Notification
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        /*return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');*/
                    //route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))

                    /*return (new MailMessage)
                    ->subject(Lang::get('Solicitud de restablecimiento de contraseña'))
                    ->greeting('Hola '. $notifiable->name)
                    ->line(Lang::get('Se solicitó un restablecimiento de contraseña para tu cuenta ' . $notifiable->getEmailForPasswordReset() . ', haz clic en el botón que aparece a continuación para cambiar tu contraseña.'))
                    ->action(Lang::get('Cambiar contraseña'), url(config('app.url') . route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
                    ->line(Lang::get('Si tu no realizaste la solicitud de cambio de contraseña, solo ignora este mensaje. '))
                    ->line(Lang::get('Este enlace solo es válido dentro de los proximos :count minutos.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]));*/

                    return (new MailMessage)
                    ->subject('Solicitud de restablecimiento de contraseña')
                    ->greeting('Hola '. $notifiable->name)
                    ->line('Se solicitó un restablecimiento de contraseña para tu cuenta ' . $notifiable->getEmailForPasswordReset() . ', haz clic en el botón que aparece a continuación para cambiar tu contraseña.')
                    ->action('Cambiar contraseña', route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false))
                    ->line('Si tu no realizaste la solicitud de cambio de contraseña, solo ignora este mensaje. ')
                    ->line('Este enlace solo es válido dentro de los proximos :count minutos.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]);



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
}
