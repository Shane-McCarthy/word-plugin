<?php
/*
Plugin Name: Phongs plugin
Plugin URI: http://www.sthomasmccarthy.com/firstPlugin/
Description: This plugin does things you never thought were possible.
Author: S. Thomas
Version: 1.0
Author URI: http://www.sthomasmccarthy.com/

Copyright 2014  S. Thomas

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
//$wp_version get the current version of wordpress.
global $wp_version ;

    if(!version_compare($wp_version,"3.0",">=")){
        die("You need at least version 3.0 to use this plugin");
    }

function my_plugin_act (){
    // can do DB crreate and other startupp actions here.
    $file = './../logs/activation-log.txt';
// Open the file to get existing content
    $current = file_get_contents($file);
// Append a new person to the file
    $current .= "Phongs Plugin was activated ";
    $timestamp = time();
    $current.= strftime("%m/%d/%y",$timestamp)."\n";
// Write the contents back to the file
    file_put_contents($file, $current);
}

register_activation_hook(__FILE__,"my_plugin_act");

function deactivate_plugin(){

    $file = './../logs/activation-log.txt';
// Open the file to get existing content
    $current = file_get_contents($file);
// Append a new person to the file
    $current .= "Phongs Plugin was de-activated ";
    $timestamp = time();
    $current.= strftime("%m/%d/%y",$timestamp)."\n";
// Write the contents back to the file
    file_put_contents($file, $current);
}

register_deactivation_hook(__FILE__,"deactivate_plugin");
