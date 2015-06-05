<?php
use Goutte\Client;

 
$client = new Client();
 
// Login page
$crawler = $client->request('GET', 'http://x3demob.cpx3demo.com:2082/login/');
 
// Select Login form
$form = $crawler->selectButton('Log in')->form();
 
// Submit form
$crawler = $client->submit($form, array(
    'user' => 'x3demob',
    'pass' => 'x3demob',
));