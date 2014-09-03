<?php
/**
 * Colletion of routes for the public faceing pages of the website.
 * @author  Peter Heywood <peethwd@gmail.com>
 */

$app->get('/', function () use ($app) {
    // Data to be output
    $config = $app->config('config');

    $projectDirs = isset($config["project_dirs"]) ? $config["project_dirs"] : array();
    $urlPatterns = isset($config["url_patterns"]) ? $config["url_patterns"] : array();
    $groupedProjects = \EarthThatWas\Project::loadProjects($projectDirs, $urlPatterns);

    $viewData = array(
            "config" => $config,
            "hostname" => gethostname(),
            "groupedProjects" => $groupedProjects,
    );
    $app->render('earththatwas.twig', $viewData);
});
