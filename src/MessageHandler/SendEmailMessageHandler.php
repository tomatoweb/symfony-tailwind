<?php

namespace App\MessageHandler;

use App\Message\SendEmailMessage;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

#[AsMessageHandler]
final class SendEmailMessageHandler
{

    public function __construct(private MailerInterface $mailer)
    {
      
    }

    public function __invoke(SendEmailMessage $message): void
    {
      $email = (new Email())
      ->from($message->user)
      ->to($message->user)
      //->cc('cc@example.com')
      //->bcc('bcc@example.com')
      //->replyTo('fabien@example.com')
      //->priority(Email::PRIORITY_HIGH)
      ->subject('Time for Symfony Mailer!')
      ->text($message->user)
      ->html('<p>See Twig integration for better HTML integration!</p>');  

      // Send email 3 times with 3 sec between each sending, to test Messenger async queueing
      for ($i=0; $i < 3 ; $i++) {
        sleep(3);
        $this->mailer->send($email);
      }
    }
      
  
    
}
