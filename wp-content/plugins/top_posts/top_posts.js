/**
 * Created by sthomas on 27/05/14.
 */
jQuery(document).ready(function($){
       $("div.tpp_posts").mouseover(function()
    {
        var div = $(this);
        $.post('wp-admin/admin-ajax.php', {
            /* the action below is reference to wp_ajax_nopriv_tpp_comments action name */
            action: "tpp_comments",
            post_id: $(this).find("a").attr("id")
        }, function(data){
            div.append($(data));
        }
        );
        return false;
    });
    $("div.tpp_posts").mouseout( function (){
        $("#post").remove();
    });
});