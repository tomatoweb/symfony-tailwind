<?php

namespace App\Services;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NewsApiProvider {

  public function __construct(  

    private HttpClientInterface $client,
    
    #[Autowire('%api_news_key%')]
    private string $apikey
  )
  {
    
  }

  public function getNews() : iterable {

    $response = $this->client->request(
      'GET',
      'https://newsapi.org/v2/everything?q=apple&from='
        .date("Y-d-m").'&to='.date("Y-d-m", strtotime("yesterday"))
        .'&sortBy=popularity&apiKey='
        .$this->apikey
    );

    return $response->toArray();
  }

}