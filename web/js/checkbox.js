
jQuery(document).ready(function($){
    $("input:checkbox").bind("change", function () {
        console.log($(this).data('id'));
        var my_id = $(this).data('id');
        var checked=0;
        if ($(this).is(":checked"))
        {
          checked=1;
        }
        console.log(checked);
        console.log(putb);

var request = jQuery.ajax({
   url: "/backend/web/portfolio/change",
   method: "POST",
   data: { id: my_id, status: checked },
   dataType: "html"
});

request.done(function(argument) {
   console.log(argument);
});
    });
});
//