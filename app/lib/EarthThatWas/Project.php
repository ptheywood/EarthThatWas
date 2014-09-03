<?php
/**
 * Class to represent a project, some simple functions and a sttatic loader (Could do this in a controller i suppose)
 * @author  Peter Heywood <peethwd@gmail.com>
 */

namespace EarthThatWas;

class Project {
    // Class constants
    const URL_PATTERN_REPLACEMENT = "{:}";
    const DEFAULT_URL_PATTERN = "/{:}";

    // Class static variables
    private static $EXCLUDED_DIRS =  array("..", ".");

    // Class variables
    private $title = null;
    private $path = null;
    private $href = null;


    /**
     * Constructure with optional params for each class var and url pattern
     * @param str $title      title for project
     * @param str $path       path to project folder
     * @param str $href       link to project
     * @param str $urlPattern optional ulr pattern for creating href
     */
    function __construct($title = null, $path = null, $href = null, $urlPattern = null){
        $this->setTitle($title);
        $this->setPath($path);
        $this->setHref($href, $urlPattern);
    }

    /**
     * Get the project title
     * @return str project title
     */
    public function getTitle(){
        return $this->title;
    }

    /**
     * Get the project path
     * @return str project path
     */
    public function getPath(){
        return $this->path;
    }

    /**
     * Get the project href
     * @return str project href
     */
    public function getHref(){
        return $this->href;
    }

    /**
     * Set the project title
     * @param str $title project title
     */
    public function setTitle($title){
        $this->title = $title;
    }

    /**
     * Set the project path
     * @param str $path project path
     */
    public function setPath($path){
        $this->path = $path;
    }

    /**
     * Set the project href, optionally using a pattern
     * @param str $href       project href or part of pattern (if pattern not null)
     * @param str $urlPattern url pattern to map the href into using the pattern replacement
     */
    public function setHref($href, $urlPattern = null){
        if($urlPattern == null){
            $this->href = $href;
        } else {
            $this->href = str_replace(self::URL_PATTERN_REPLACEMENT, $href, $urlPattern);
        }
    }

    /**
     * Load a selection of projects based on passed in list of directories and any patterns they should map to
     * @param  array $dirs        array of directories to look for projects in
     * @param  array $urlPatterns array of url patterns, correlate to the directories
     * @return array              array of Project instances
     */
    public static function loadProjects($dirs, $urlPatterns){
        $groupedProjects = array();
        if(is_array($dirs)){
            foreach($dirs as $key => $dir){
                $projects = array();
                if(is_dir($dir)){
                    $projectDirs = array_diff(scandir($dir), self::$EXCLUDED_DIRS);
                    foreach($projectDirs as $projectDir){
                        $path = Utils::joinPaths(array($dir, $projectDir));
                        if(is_dir($path)){
                            $urlPattern = (is_array($urlPatterns) && isset($urlPatterns[$key])) ? $urlPatterns[$key] : self::DEFAULT_URL_PATTERN;
                            $project = new Project($projectDir, $path, $projectDir, $urlPattern);
                            array_push($projects, $project);
                        }
                    }
                } else {
                    // Error - invalid config @todo
                    var_dump("err - invalid config dir: ".$dir);
                }
                $groupedProjects[$dir] = $projects;
            }
        } else {
            // Error - dirs not an array. @todo
        }
        return $groupedProjects;
    }

    /**
     * Project::loadProjects($dirs, $urlPatterns) lazy method extracting the approprate data from $config instead.
     * @param  array $config Configuration array - from the \EarthThatWas\Config class.
     * @return array         array of projects
     */
    public static function loadProjectsViaConfig($config){
        if(is_array($config)){
            $projectDirs = isset($config["project_dirs"]) ? $config["project_dirs"] : array();
            $urlPatterns = isset($config["url_patterns"]) ? $config["url_patterns"] : array();
            return self::loadProjects($projectDirs, $urlPatterns);
        } else {
            // Error - invalid config. Just silentlt fail for now. @todo
            return array();
        }

    }
}
