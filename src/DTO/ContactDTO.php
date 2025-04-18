<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

// Alternative 
use Symfony\Component\Validator\Constraints as Assert;


/* le but des DTO est de déplacer des données dans des appels distants coûteux (web api), des données ne provenant pas de la DB */


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