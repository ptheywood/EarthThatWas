<?php
/**
 * Colletion of routes for the public faceing pages of the website.
 * @author  Peter Heywood <peethwd@gmail.com>
 */

$app->get('/', function () use ($app) {
    // Data to be output
    $confArr = $app->config('config');
    $viewData = array(
            "config" => $app->config('config'),
            "hostname" => gethostname(),
    );
    $app->render('earththatwas.twig', $viewData);
});
