<?php
/*
Plugin Name: S Thomas's post info plugin  Plugin
Plugin URI:
Description: This plugin will store the user agents for later parsing and display
Author: S Thomas
Version: 1.0
Author URI:
 */

    function tpp_post_widget (){
//http://codex.wordpress.org/Template_Tags
       //can do it with array as well
       //$tpp_post_query = new WP_Query ();
        $tpp_post_query = new WP_Query (array('post_per_page'=>5,
                                         'orderby'=>'comment_count',
                                            'order'=>'DESC',
                                                'post_in',get_option('sticky_posts')));
       //$tpp_post_query->query("&posts_per_page=5&orderby=comment_count&order=DESC");
        ?>
        <h3>Top Posts: </h3>
            <?php if ($tpp_post_query->have_posts()) :
                    while ($tpp_post_query->have_posts()):
                        $tpp_post_query->the_post();
                ?>
            <div class="tpp_posts">
                <a href="<?php echo the_permalink();  ?> "
                  id="<?php echo the_id(); ?>"
                   title="<?php echo the_title();   ?> "
                    class="comment_links"> <?php the_title(); ?></a>
                (<?php echo comments_number();  ?> )

            </div>
    <?php endwhile;
            endif ;
        ?>
<?php

}
function tpp_post_comments_return()
{
    $post_id = isset( $_POST ['post_id']) ? $_POST['post_id'] : 0 ;
    if ( $post_id >0 ){
        $post = get_post($post_id);
        ?> <div id="post"><?php echo $post->post_content;  ?></div>
        <?php
    }
    die();
}
// register the function with ajax using an action name ie: 'wp_ajax_nopriv**actionname**'
add_action ('wp_ajax_nopriv_tpp_comments','tpp_post_comments_return');

function tpp_post_widget_init(){
    wp_register_sidebar_widget('top_post_1','Top Post','tpp_post_widget');
}

add_action('widgets_init','tpp_post_widget_init');

function tpp_posts_get_scripts()
{
    wp_enqueue_script("tpp-posts",
    path_join(WP_PLUGIN_URL, basename( dirname(__FILE__))."/top_posts.js"), array("jquery"));
}
add_action ('wp_print_scripts', 'tpp_posts_get_scripts');