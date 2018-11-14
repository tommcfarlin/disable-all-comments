<?php
/**
 * Disable All Comments
 *
 * Disables all WordPress comments while also allowing you to turn them back on at a per-post level.
 *
 * @package   DisableAllComments
 * @author    Tom McFarlin <tom@tommcfarlin.com>
 * @license   GPL-3.0+
 * @link      https://github.com/tommcfarlin/disable-all-comments
 * @copyright 2018 Tom McFarlin
 *
 * @wordpress-plugin
 * Plugin Name:       Disable All Comments
 * Plugin URI:        https://github.com/tommcfarlin/disable-all-comments
 * Description:       Disables all WordPress comments while also allowing you to turn them back on at a per-post level.
 * Version:           0.1.0
 * Author:            Tom McFarlin
 * Author URI:        http://tommcfarlin.com
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 */


namespace BloggingPlugins;

use BloggingPlugins\Utilities\Registry;
use BloggingPlugins\Subscriber\CommentStatusMetaBoxSubscriber;

// Prevent this file from being called directly.
defined('WPINC') || die;

// Include the autoloader.
require_once __DIR__ . '/inc/autoload.php';

// Setup a filter so we can retrieve the registry throughout the plugin.
$registry = new Registry();
add_filter('bpRegistry', function () use ($registry) {
    return $registry;
});

// Setup the WordPress adminsitration area.
$registry->add('commentStatusMetaBoxSubscriber', new CommentStatusMetaBoxSubscriber('add_meta_boxes'));

// Start the machine.
$plugin = new Plugin($registry);
$plugin->start();
