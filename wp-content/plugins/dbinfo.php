<?php
/*
Plugin Name: Phongs DB dashboard info  plugin
Plugin URI: http://www.sthomasmccarthy.com/firstPlugin/
Description: This plugin does things you never thought were possible.
Author: S. Thomas
Version: 1.0
Author URI: http://www.sthomasmccarthy.com/
*/

function databaseinfo_dashboard_widget (){
    // this is the global WP databse object
    global $wpdb;
    global $current_user;

    ?>
        <h2>DB Info Dashboard widget </h2>
        <pre><?php
            // this var_dump allows you to output the information in an object.
           // echo var_dump($wpdb);
            ?></pre>
        <p><b>Last Query: </b><?php echo $wpdb->last_query;  ?> </p>
        <p><b>Last Error: </b><?php echo $wpdb->last_error;  ?> </p>
        <p><b>Total Users: </b><?php echo $wpdb->query('SELECT ID FROM wp_users');  ?> </p>
        <p><b>Last Post : </b><?php echo $wpdb->get_var('SELECT post_title FROM ' . $wpdb->posts. ' WHERE post_author = ' . $current_user->ID);  ?> </p>
        <p><b>User Emails : </b><?php $user_emails =  $wpdb->get_col('SELECT user_email FROM ' . $wpdb->users);   foreach($user_emails as $emails){
        echo "<pre>".$emails."</pre>";
    } ?>
    <p><b>Your User Info: </b>
     <?php $my_user_data = $wpdb->get_row('SELECT * FROM '. $wpdb->users.' WHERE ID = '.$current_user->ID,ARRAY_A); /*OR USE ARRAY_N TO GET NUMBERED OUTPUT */
     foreach ($my_user_data as $user_data){
         echo "<pre>".$user_data."</pre>";
     }  ?></p>
    <p><b>Post all terms: </b><?php  $terms = $wpdb->get_results('SELECT * FROM '. $wpdb->terms);

            echo "<pre>".var_dump($terms)."</pre>";

        ?> </p>

<?php
}

function databaseinfo_register_widget ()
{
    wp_add_dashboard_widget('databaseinfo-dashboard-widget','Counter Dashboard Widget','databaseinfo_dashboard_widget');
}

add_action('wp_dashboard_setup','databaseinfo_register_widget');