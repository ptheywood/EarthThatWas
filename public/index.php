<?php
/**
 * Main file for all requests to pass through, loads the app and then returns the correct response based on the route.
 * @author  Peter Heywood <peethwd@gmail.com>
 */

// Start php session.
session_cache_limiter(false);
session_start();

// Load autoloader
require '../vendor/autoload.php';

// Setup app
$app = new \Slim\Slim(array(
    'debug' => true,
    'view' => new \Slim\Views\Twig(),
    'templates.path' => '../app/templates',
    'log.enabled' => true,
));
$env = $app->environment;
$env['slim.errors'] = fopen('../error/slim.log', 'a');

$app->view->parserOptions = array(
    'charset' => 'utf-8',
    'cache' => realpath('../templates/cache'),
    'auto_reload' => true,
    'strict_variables' => false,
    'autoescape' => true
);

// Create hook to load config prior to each route. This enables slim's Exception handler for missing file exceptions.
$app->hook("slim.before.router",function() use ($app){
    $conf = \EarthThatWas\Config::loadConfig();
    $app->config('config', $conf);
});

// Routing
require '../app/routes/public.php';

// Run
$app->run();
