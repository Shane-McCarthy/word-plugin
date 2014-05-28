<?php
/*
Plugin Name: S Thomas shortcode plugin
Plugin URI: http://www.sthomasmccarthy.com/firstPlugin/
Description: Sets shortcode for use in posts .
Author: S. Thomas
Version: 1.0
Author URI: http://www.sthomasmccarthy.com/
*/

function smp_map_it ($atts,$content = null ){
    shortcode_atts( array('title'=> 'Your Maps', 'address'=>''), $atts);
$base_map_url = 'http://maps.google.com/maps/api/staticmap?sensor=false&size=256x256&format=png&center=';
return '
<h2>' . $atts['title']. '</h2>
    <img width="256" height="256" src="'. $base_map_url . urlencode($atts['address']).'"/>';
}
add_shortcode('map-it','smp_map_it');