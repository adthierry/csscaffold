<?php

/**
 * This file acts as the "front controller" for CSScaffold. You can
 * configure your CSScaffold, modules, plugins and system directories here.
 * PHP error_reporting level may also be changed.
 *
 * @see https://github.com/anthonyshort/csscaffold/tree/master
 */
 
/**
 * Define the website environment status. When this flag is set to TRUE, 
 * errors in your css will result in a blank page rather than displaying
 * error information to the user.
 */
define('IN_PRODUCTION', FALSE);

/**
 * The document root for the server. If you're server doesn't set this
 * variable, you can manually enter in the server path to the document root
 */
$document_root = $_SERVER['DOCUMENT_ROOT'];

/**
 * CSScaffold system directory. This directory should contain the core/ directory,
 * and the resources you included in your download of CSScaffold.
 *
 * This path can be relative to this file or absolute from the document root.
 */
$scaffold_system = "scaffold";

/**
 * Make sure the we're using PHP 5.2 or newer
 */
version_compare(PHP_VERSION, '5.2', '<') and exit('CSScaffold requires PHP 5.2 or newer.');

/**
 * Set the error reporting level. Unless you have a special need, E_ALL is a
 * good level for error reporting.
 */
error_reporting(E_ALL & ~E_STRICT);

/**
 * Setting it to false will remove all errors
 */
ini_set('display_errors', TRUE);

/**
 * If you rename all of your .php files to a different extension, set the new
 * extension here. This option can left to .php, even if this file has a
 * different extension.
 */
define('EXT', '.php');

/**
 * Don't touch anything below here.
 */
$path = pathinfo(__FILE__);

# This file
define('FRONT', $path['basename']);
define('DOCROOT', $document_root.DIRECTORY_SEPARATOR);

# If this is a symlink, change to the real file
is_link(FRONT) and chdir(dirname(realpath(__FILE__)));

# Check if the system path is relative or absolute
$scaffold_system = file_exists($scaffold_system) ? $scaffold_system : DOCROOT.$scaffold_system;

# Set the constants
define('CSSPATH', $path['dirname'].DIRECTORY_SEPARATOR);
define('SYSPATH', str_replace('\\', '/', realpath($scaffold_system)).'/');

# Clean up
unset($scaffold_system, $document_root, $path); 

if(file_exists(SYSPATH.'install'.EXT))
{
	require SYSPATH.'install'.EXT;
}
else
{
	require SYSPATH.'core/Bootstrap'.EXT;
}
