<?php

namespace AppBundle\Tests;


$client = new \GuzzleHttp\Client();

$request = $this->client->post("http://localhost:8000/articles",array(
                'content-type' => 'application/json'
        ),array());
//$request->setBody({'title': 'Monadd', 'leadingg': 'monleading', 'body': 'mondihfj', 'createdBy' :'matthieu'}); #set body!
$response = $request->send();

echo $response->getStatusCode();
// 200
echo $response->getHeaderLine('content-type');
// 'application/json; charset=utf8'
echo $response->getBody();