<?php

namespace App\Repositories\GitHub;

use Github\HttpClient\CachedHttpClient;
use Github\Client;
use App\Gist;

/**
 * gist
 */
class Gist
{

  public function all()
  {
    return collect($this->getClient()->api('gists')->all())
              ->map(function($gist){
                return new Gist($gist);
              });

  }

  public function show($id)
  {
    $gist = $this->getClient()->api('gists')->show($id);

    return new Gist($gist);
  }

  protected function getClient()
  {
    $httpClient = new CachedHttpClient([
      'cache_dir' => storage_path(config('services.github.cache_url'))
    ]);
    $client = new Client($httpClient);
    //dd($client);
    $client->authenticate(auth()->user()->github_token, 'http_token');

    return $client;
  }

}
