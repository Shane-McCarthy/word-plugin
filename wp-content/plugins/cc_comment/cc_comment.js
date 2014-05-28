/**
 * Created by sthomas on 25/05/14.
 */
jQuery(document).ready( function($){
    $("input[name='cccomm_cc_email']").blur(function(){
        $.ajax({
            type: "POST",
            data: "cccomm_cc_email="+$(this).attr("value") + "&action=cccomm_cc_email_check",
            url: ajaxurl,
            beforeSend : function(){
                $("#emailInfo").html("Checking Email...");
            },
            success: function(data){
                /*the data that we are getting back is either valid or invalid from the php function*/
                if (data == "valid"){
                    $("#emailInfo").html("Email Ok ");
                }else {
                    $("#emailInfo").html("You have entered an invalid email");
                }
            }
        });
    });
});