<?php
/**
 * Config static class to load data from a config file.
 * @author  Peter Heywood <peethwd@gmail.com>
 */

namespace EarthThatWas;

class Config {
    // Path to config file, located in the app folder.
    const CONFIG_PATH = "../app/config.ini";


    /**
     * Statically load data from the config ini file.
     * @return array array of config options. Throws Exception on missign ini file?
     */
    public static function loadConfig(){
        if(!file_exists(self::CONFIG_PATH)){
            throw new \Exception('Configuration File Missing: '. realpath(null) . '/' . self::CONFIG_PATH);
        } else {
            return parse_ini_file(self::CONFIG_PATH);
        }
    }

}
