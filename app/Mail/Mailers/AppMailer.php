<?php

namespace App\Mail\Mailers;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Users;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AppMailer extends Mailable
{
  use Queueable, SerializesModels;
  /**
   * The Laravel Mailer instance.
   *
   * @var Mailer
   */
  public $mailer;

  /**
   * The sender of the email.
   *
   * @var string
   */
  public $from = 'nicbryan779@gmail.com';

  /**
   * The recipient of the email.
   *
   * @var string
   */
  public $to;

  /**
   * The view for the email.
   *
   * @var string
   */
  public $view;

  /**
   * The data associated with the view for the email.
   *
   * @var array
   */
  public $data = [];

  /**
   * Create a new app mailer instance.
   *
   * @param Mailer $mailer
   */
  public function __construct(Mailer $mailer)
  {
      $this->mailer = $mailer;
  }

  public function sendEmailConfirmationTo(Users $user)
  {
      $this->to=$user->email;
      $this->view = 'confirm';
      $this->data = compact('user');
      $this->deliver();
  }

  public function deliver()
  {
          $this->mailer->send($this->view, $this->data, function ($message) {
          $message->from($this->from);
          $message->to($this->to);
      });
  }
  public function sendForgetPasswordTo(Users $user)
  {
      $this->to = $user->email;
      $this->view = 'forgetpassword';
      $this->data = compact('user');
      $this->deliverForgetPassword();
  }
  public function deliverForgetPassword()
  {
          $this->mailer->send($this->view, $this->data, function ($message) {
          $message->from($this->from);
          $message->to($this->to);
      });
  }
}
