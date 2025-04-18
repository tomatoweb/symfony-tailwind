<?php

namespace App\Message;

final class SendEmailMessage
{

    public function __construct(
      public string $user = "math.appelmans@gmail.com", 
      public string $text = "Sending emails is fun again!"
    )
    {
      
    }
}
