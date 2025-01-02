<?php

namespace App\Services;

interface NewsProviderInterface
{
    public function getNews(): iterable;
    
}    