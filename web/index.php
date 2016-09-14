<?php

require_once __DIR__.'/../vendor/autoload.php'; 

$app = new Silex\Application(); 

$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

$app->get('/', function() use($app) { 
    // return 'Hello '.$app->escape($name); 
    return $app['twig']->render('index.twig', []);
}); 

$app->run(); 