<?php
/*
Plugin Name: S Thomas Template tag plugin
Plugin URI: http://www.sthomasmccarthy.com/firstPlugin/
Description: Sends a welcome message .
Author: S. Thomas
Version: 1.0
Author URI: http://www.sthomasmccarthy.com/
*/

// first we check to see the version then we declare a function that outputs the custom copyright info.
// once it is activated it will show at the bottom of the screen or where ever we place it.

global $wp_version ;
if (!version_compare($wp_version,"3.0",">=")){
    die ("you need at least version 3.0 of Wordpress to use this plugin");
}
 function add_copywrite(){
     $copyright_message = "&copy; ". date('Y'). " S Thomas McCarthy. All rights Reserved. ";
     echo $copyright_message;
 }