<?php
/*
Plugin Name: Phongs Email New Comments plugin
Plugin URI: http://www.sthomasmccarthy.com/firstPlugin/
Description: This plugin does things you never thought were possible.
Author: S. Thomas
Version: 1.0
Author URI: http://www.sthomasmccarthy.com/
*/

// is the start of the actions that with protect against CRSF attacks by supplying a unique ID.
function cccomm_init()
{
    // the 1st input is the form id, the second and possibly others are the input names from the form ie: email, password.
    register_setting('cccomm_options','cccomm_cc_email');
}
add_action('admin_init','cccomm_init');

//declares the field that gets called for the admin settings action function
function cccomm_setting_field()
{
    ?>
    <input type="text" name="cccomm_cc_email" id="cccomm_cc_email"
           value="<?php echo get_option('cccomm_cc_email'); ?>" />
    <div id="emailInfo" align="left"></div>
<?php
}

//declares a header for the admin settings section
function cccomm_setting_section()
{
    ?>
    <p>Settings for the CC Comments plugin:</p>
<?php
}


//declares the functions with the names that will be shown in the settings section
// you would be able to add as many as you want here.
function cccomm_plugin_menu()
{
    add_settings_section('cccomm','CC Comments','cccomm_setting_section','general');
    add_settings_field('cccomm_cc_email', 'CC Comments Email','cccomm_setting_field','general','cccomm');
}

// action hook to make it happen, in this case it is adding the above admin menu options.
add_action('admin_menu', 'cccomm_plugin_menu');


// this is the old options page functions where it belonged to its own section in the side bar.

/*function cccomm_option_page()
{
    ?>
    <div class="wrap"><?php screen_icon(); ?>
        <h2>CC Comments Option Page</h2>
        <p>Welcome to the CC Comments Plugin. Here you can edit the email(s) you
            wish to have your comments CC'd to.</p>
        <!-- sending the form to options.php is essential to the use of the above functions. -->
        <form action="options.php" method="post" id="cc-comments-email-options-form">
            <?php
            // this connects to the register
            settings_fields('cccomm_options'); ?>
            <h3><label for="cccomm_cc_email">Email to send CC to: </label> <input
                    type="text" id="cccomm_cc_email" name="cccomm_cc_email"
                    value="<?php echo esc_attr( get_option('cccomm_cc_email') ); ?>" /></h3>
            <p><input type="submit" name="submit" value="Update Email" /></p>
        </form>
    </div>
<?php
}
*/
// this is the old options page functions where it belonged to its own section in the side bar.
/*
function cccomm_plugin_menu()
{
    add_options_page('CC Comments Settings','CC Comments', 'manage_options', 'cc-comments-plugin', 'cccomm_option_page');
    add_submenu_page('cc_comments-plugin','CC Comments Options 2', 'CC Comments Options 2', 'manage_options',
        'cc_comments-plugin2', 'cccomm_option_page');
}

add_action('admin_menu', 'cccomm_plugin_menu');
*/
function cc_comment()
{
    global $_REQUEST;

    $to = "email address";
    $subject = "New comment posted @ yourblog " . $_REQUEST['subject'];
    $message = "Message from: " . $_REQUEST['name'] . " at email: " . $_REQUEST['email'] . ": \n" . $_REQUEST['comments'];
    wp_mail($to,$subject,$message);
}

add_action('comment_post','cc_comment');

function cccomm_email_check (){
    //cccom_cc_email matches the input field from the settings input that is created above.

    $email = isset($_POST['cccomm_cc_email']) ? $_POST['cccomm_cc_email'] : null ;
    $msg = 'invalid';
    if ($email){
        if (is_email($email)){
            $msg = 'valid';
        }
    }
echo $msg;
    die();
}

// here is where we add all of the functions we just built for email checking
// the reference 'wp_ajax_cccomm_email_check' is WP prefix wp_ajax is WP and cccomm matches the action in the JS file in the data line of the ajax.
add_action ('wp_ajax_cccomm_email_check','cccomm_email_check');
add_action('admin_print_scripts-options-general.php','cccomm_email_check_script');

function cccomm_email_check_script(){
    wp_enqueue_script("cc-comments","/wp-content/plugins/cc_comment/cc_comment.js",array('jquery'));
}