<?php

namespace App\Controller;

use App\DTO\ContactDTO;
use App\Form\ContactType;
use App\Message\SendEmailMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{

    /* Send email in dev mode with Mailpit and Symfony Messenger :
    - download mailpit.exe, put it in bin directory (https://github.com/axllent/mailpit/releases/tag/v1.21.8)
    - execute mailpit: ./bin/mailpit 
    - configure .env : MAILER_DSN=smtp://localhost:1025
    - configure messenger.yaml: 

      framework:
      messenger:
          failure_transport: failed

          transports:
              # https://symfony.com/doc/current/messenger.html#transport-configuration
              async:
                  dsn: '%env(MESSENGER_TRANSPORT_DSN)%'
                  options:
                      use_notify: true
                      check_delayed_interval: 60000
                  retry_strategy:
                      max_retries: 3
                      multiplier: 2
              failed: 'doctrine://default?queue_name=failed'
              sync: 'sync://'

          default_bus: messenger.bus.default

          buses:
              messenger.bus.default: []

          routing:
              Symfony\Component\Mailer\Messenger\SendEmailMessage: sync
              Symfony\Component\Notifier\Message\ChatMessage: sync
              Symfony\Component\Notifier\Message\SmsMessage: sync
              

    */

    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, MessageBusInterface $bus): Response
    {
        $data = new ContactDTO();

        // test data
        $data->name = 'John Doe';
        $data->email = 'math.appelmans@gmail.com';
        $data->message = 'some message text...';

        $form = $this->createForm(ContactType::class, $data);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
                $bus->dispatch(new SendEmailMessage());

                $this->addFlash('success', 'Email send successfully !');
                return $this->redirectToRoute('contact');
            
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form
        ]);
    }
}
