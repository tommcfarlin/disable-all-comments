<?php
/**
 * Plugin autoloader.
 *
 * @package BloggingPlugins\inc
 */

namespace BloggingPlugins\inc;

/**
 * Automatically loads the specified file.
 *
 * Examines the fully qualified class name, separates it into components, then creates
 * a string that represents where the file is loaded on disk.
 *
 * @package Feast\inc
 */
spl_autoload_register(function ($filename) {

    // First, separate the components of the incoming file.
    $filePath = explode('\\', $filename);

    // Locate the 'BloggingPlugins' namespace and remove it from the array.
    $bloggingPluginsKey = 'BloggingPlugins';
    $result = array_search($bloggingPluginsKey, $filePath, true);
    if (false !== $result) {
        unset($filePath[$result]);
        $filePath = array_values($filePath);
    }

    /**
     * - The first index will always be BloggingPlugins since it's part of the plugin.
     * - All but the last index will be the path to the file.
     */

    // Get the last index of the array. This is the class we're loading.
    if (isset($filePath[count($filePath) - 1])) {
        $classFile = strtolower(
            $filePath[ count( $filePath ) - 1 ]
        );

        // The classname has an underscore, so we need to replace it with a hyphen for the file name.
        $classFile = str_ireplace('_', '-', $classFile);
        $classFile = "class-$classFile.php";
    }

    /**
     * Find the fully qualified path to the class file by iterating through the $filePath array.
     * We ignore the first index since it's always the top-level package. The last index is always
     * the file so we append that at the end.
     */
    $fullyQualifiedPath = trailingslashit('src');

    $l = count($filePath) - 1;
    for ($i = 0; $i < $l; $i++) {
        $dir = $filePath[ $i ];
        $fullyQualifiedPath .= trailingslashit($dir);
    }
    $fullyQualifiedPath .= $classFile;
    $fullyQualifiedPath = trailingslashit(
        dirname(
            dirname(__FILE__)
        )
    ) . $fullyQualifiedPath;

    // Now we include the file.
    if (file_exists($fullyQualifiedPath)) {
        include_once($fullyQualifiedPath);
    }
});
