<?php
/*
Plugin Name: Simple Dashboard Widget
Plugin URI: http://www.sthomasmccarthy.com/simpleDBWidget/
Description: This plugin adds a widget to the admin dashboard
Author: S Thomas
Version: 1.0
Author URI: http://www.sthomasmccarthy.com
 */

// the function that have the HTML
function simple_dashboard_widget()
{
    ?>
    <h2>Simple Dashboard Widget</h2>
    <p>Welcome to WordPress development. Now you can build your own dashboard widgets. For fun and profit!</p>
    <p><a href="http://www.sthomasmccarthy.com">Visit S. Thomas McCarthy Portfolio</a></p>
<?php
}

// the function to register the widget
function sdbw_register_widget()
{
    wp_add_dashboard_widget('simple-dashboard-widget','Simple Dashboard Widget', 'simple_dashboard_widget');
}

//as always the call to action 
add_action('wp_dashboard_setup', 'sdbw_register_widget');
