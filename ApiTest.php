<?php

require __DIR__.'/vendor/autoload.php';

/** TEST VERIFICATION DELETE METHOD
*/


$client = new \GuzzleHttp\Client([
    'base_uri' => 'http://localhost:8000',
      'defaults' => [
        'exceptions' => false
    ]]);

$data = array(
    'title' => 'Titre 1',
    'leadingg' => 'Caption',
    'createdBy' => 'matthieu',
    'body' => 'Corps du l\'article'
);

$response = $client->post('/articles',[ 
    'body' => json_encode($data)
    ]);

echo $response->getStatusCode();
echo "\n\n";

$url =  $response->getHeaderLine('location');
echo "L'article crée est le suivant \n";
echo $response->getStatusCode();
echo "\n";
echo $response->getBody();
echo "\n\n";

$resp = $client->request('GET', 'http://localhost:8000'.$url);
echo $resp->getStatusCode();
echo "\n";
echo $resp->getBody();

echo "\n\n";

$res = $client->request('DELETE', 'http://localhost:8000'.$url);
echo $res->getStatusCode();
echo "\n";
echo $res->getBody();
echo 'L\'article a été suprimé';
echo "\n\n";
echo "Liste des articles : \n";


$resp = $client->request('GET', 'http://localhost:8000/articles');
echo $resp->getStatusCode();
echo "\n";
echo $resp->getBody();

echo "\n\n";
