<?php

/**
 * Plugin Name: Plyr Embed
 * Description: Replaces Vimeo & Youtube videos with the Plyr video player
 * Version: 0.1
 * Author: Storm Rockwell
 * Author URI: http://www.stormrockwell.com
 * License: GPL-2.0+
 */

require_once plugin_dir_path( __FILE__ ) . '/inc/class-plyr-embed.php';
require_once plugin_dir_path( __FILE__ ) . '/inc/functions.php';

$plyr_embed = new Plyr_Embed();
