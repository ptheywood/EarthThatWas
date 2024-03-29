<?php
/**
 * Colletion of routes for the public faceing pages of the website.
 * @author  Peter Heywood <peethwd@gmail.com>
 */

$app->get('/', function () use ($app) {
    // Data to be output
    $config = $app->config('config');

    $groupedProjects = \EarthThatWas\Project::loadProjectsViaConfig($config);

    $viewData = array(
            "config" => $config,
            "hostname" => gethostname(),
            "groupedProjects" => $groupedProjects,
    );
    $app->render('earththatwas.twig', $viewData);
});
