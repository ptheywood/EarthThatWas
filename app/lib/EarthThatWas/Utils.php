<?php
/**
 * Class of static utility methods, keeps then grouped rather than just being an include.
 * @author  Peter Heywood <peethwd@gmail.com>
 */

namespace EarthThatWas;

class Utils {

    /**
     * Join a series of path parts together using the environments directory separator. Removes duplicate directory separators.
     * @param  array $parts array of string parts
     * @return string        joined string built from parts.
     */
    public static function joinPaths($parts){
        // Insert the seperator between each part
        $path = implode(DIRECTORY_SEPARATOR, $parts);
        // Remove any double directory separators.
        $path = preg_replace('/(\\'.DIRECTORY_SEPARATOR.'+)/','/',$path);
        return $path;
    }
}
