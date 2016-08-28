/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery( document ).ready(function($) {
    
    var dropzone  = document.getElementsByClassName('dropzone');
    if(dropzone){
        dropzone.ondrop = function(e){
            e.preventDefault();
        };
        
        $( ".images_thumbnails" ).delegate('.dropzone .close' , 'click', function(e) {
            e.preventDefault();
            var id = parseInt( $(this).parent('.dropzone').prop("id").match(/\d+/g), 10 );
            var nth= parseInt($(".dropzone").index( $(this).parent('.dropzone')), 10 );
            
            $('#imageFile' + id).remove();
            $('#dropzone' + id).remove();
            
            var paths = $("#userlicenses-images").val();
            var images_array=paths.split('|');
            images_array.splice(nth, 1);
            
            var result_string=images_array.join("|");
            $("#userlicenses-images").val(result_string);
        });


        $( ".images_thumbnails" ).delegate('.dropzone' , 'click', function() {
                var id = parseInt( $(this).prop("id").match(/\d+/g), 10 );     
                $('#open_browse' + id).trigger('click');
                dropzone_id = '#'+$(this).attr('id');
        });

        $("form").delegate('.input_image_faile', 'change', function(event) {

            var $last_dropezone = $('.images_thumbnails .dropzone:last');
            var last_id = parseInt( $last_dropezone.prop("id").match(/\d+/g), 10 );
            var id = parseInt( $(this).prop("id").match(/\d+/g), 10 );


            //In this case we add new thumbnail element with new id
            //And add new clone input fild [type='file']
            if(last_id==id){
                // get the last DIV which ID starts with ^= "klon"
                var $div = $('div[id^="dropzone"]:last');

                // And increment that number by 1
                var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) +1;

                // Clone it and assign the new ID (i.e: from num 4 to ID "klon4")
                var $dropzone = $div.clone().prop('id', 'dropzone'+num );

                // >>> Append $dropzone to the end
                $('.images_thumbnails').append($dropzone);

                //copy last and add new input file
                var input_file= $('.imageFile:last').last();

                var $input_file_new = input_file.clone().prop('id', 'imageFile'+num ).css('display', 'none');
                $input_file_new.children('.input_image_faile').prop('id', 'open_browse'+ num );
                $('.imageFile').parent( "form" ).append($input_file_new);
            }

            var tmppath = URL.createObjectURL(event.target.files[0]);
            $("#dropzone" + id).css("background", "url('" + URL.createObjectURL(event.target.files[0]) + "')");

            //Change paths to images in the fields userlicenses-images
            var upload_image_path = $(this).val();
            var paths = $("#userlicenses-images").val();
            var images_array=paths.split('|');
            var upload_image_path_array=upload_image_path.split('\\'); 
            var image_name= upload_image_path_array[upload_image_path_array.length - 1];
            if($(this).val()){
                images_array[id] = image_name;
                if((id+1)==images_array.length){
                    images_array[id+1] = '';
                }
            }
            
            var result_string=images_array.join("|");
            $("#userlicenses-images").val(result_string);
            //add new input field and
        });
    }
});