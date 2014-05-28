<?php
/*
Plugin Name: Simple Widget
Plugin URI: http://www.sthomasmccarthy.com/firstPlugin/
Description: This plugin does things you never thought were possible.
Author: S Thomas
Version: 1.0
Author URI: http://www.sthomasmccarthy.com/
 */

class SimpleWidget extends WP_Widget {
        // this class uses and extends the built in WP_WIDGET class
    function SimpleWidget (){
                // constructor
        $widget_options = array(
            'classname' => 'simple-widget',
            'description' => 'Just a simple widget'
        );
        parent::WP_Widget('simple-widget','Simple Widget', $widget_options);
        }
    function widget ($args,$instance){
        // $args is an object so we need to take what we need but skip the rest
        extract ($args, EXTR_SKIP);
        $title = ($instance['title']) ? $instance ['title'] : 'A simple widget default';
        $body = ($instance['body'])? $instance['body'] : 'A simple message default';
        // closing the PHP below allows us to output like a PHP file instead of just the WP function.
        ?>
        <?php echo $before_widget ?>
        <?php echo $before_title . $title . $after_title ?>
        <p><?php echo $body ?></p>
    <?php
    }
    /*this is commented out to allow WP default to work, if you want to use it you will need to inpput 2 variables
    you will need the old instance and the new instance.
    function  update (){

    }*/
    function  form ($instance){
        ?>
        <label for="<?php echo $this->get_field_id('title');  ?>">
            Title:
            <input id="<?php echo $this->get_field_id('title'); ?>"
                name="<?php echo $this->get_field_name('title'); ?>"
                value="<?php echo esc_attr($instance['title']);  ?>"
        </label>
        <br />
        <label for="<?php echo $this->get_field_id('body'); ?>">
            Message:
            <textarea id="<?php echo $this->get_field_id('body'); ?>"
                      name="<?php echo $this->get_field_name('body'); ?>"><?php echo esc_attr( $instance['body'] ); ?></textarea>
        </label>
    <?php
    }
}
function simple_widget_init (){
    register_widget("SimpleWidget");
}
// here is where we add the action to get WP to actually use the function.
add_action('widgets_init','simple_widget_init');