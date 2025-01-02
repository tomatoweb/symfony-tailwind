<?php

namespace App\Services;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class ArticleYamlProvider implements ArticleProviderInterface
{

    public function getArticles(): iterable
    {
        try {
            return Yaml::parseFile(__DIR__.'/articles.yaml');
        } catch (ParseException $th) {
            printf('could not get articles.');
        }
    }

    

}