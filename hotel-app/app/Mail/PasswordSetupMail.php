<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class PasswordSetupMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     */
    public function build()
{
    $setupUrl = url("password-setup/{$this->token}");

    // Log the generated URL for debugging
    \Log::info("Generated Setup URL: {$setupUrl}");

    return $this->subject('Password Setup Mail')
                ->view('emails.password-setup')
                ->with([
                    'user' => $this->user,
                    'setupUrl' => $setupUrl,
                ]);
}
}
