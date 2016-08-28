jQuery(document).ready(function($){
    $(".rule").bind("click", function () {
        var role = $(this).data('role');
        var action_id = $(this).data('id');
        var status =1
        var current_element=this;
        
        if($(this).children().hasClass('glyphicon-plus')){
            status=0;
        }
        
        if ($(this).is(":checked"))
        {
          checked=1;
        }

        console.log(role);
        console.log(action_id);
        console.log(status);

        var request = jQuery.ajax({
           url: "/yii2_hspace/backend/web/action/changestatusrule",
           method: "POST",
           data: { id: action_id, role: role, status: status},
           dataType: "json"
        });

        request.done(function(argument) {
            if(argument['result']===true){
                console.log(argument);
                //change class for rule status
                if(status){
                    $(current_element).children().removeClass('glyphicon-minus').addClass('glyphicon-plus');
                }
                else{
                    $(current_element).children().removeClass('glyphicon-plus').addClass('glyphicon-minus');
                }
            }
        });
        request.fail(function(argument){
            console.log(argument);
        });
    });
});
