<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

use Symfony\Component\Validator\Constraints as Assert;


class ContactDTO
{
    #[NotBlank()]
    #[Length(min:3)]
    public $name = '';

    #[NotBlank()]
    #[Email()]
    public $email = '';

    #[NotBlank()]
    #[Length(min:3, max:200)]
    public $message = '';
}

// Alternative

class _ContactDTO
{
    #[Assert\Length(min: 5)]
    public string $name = '';

    #[Assert\Email()]
    public string $email = '';
    
    public string $message = '';
}