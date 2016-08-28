/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery( document ).ready(function($) {
    
    //console.log($('#dropzone1'));
    var avatar_image=$("#publicity-image").val();
    
    if(avatar_image){
        $("#dropzone0").css("background", "url('http://localhost/yii2_hspace/frontend/web/media/banners/" + avatar_image + "')");
    }
    
    var dropzone  = document.getElementById('dropzone0');

    if(dropzone){
        dropzone.ondrop = function(e){
                e.preventDefault();
                var img = $("#dropzone0").find("img");
                if(img.length != 1){
                        this.className = 'dropzone';
                        dropzone_id = '#dropzone0';
            }
        };

        dropzone.ondragover = function(){
                this.className = 'dropzone dragover';
                return false;
        };

        dropzone.ondragleave = function(){
                this.className = 'dropzone';
                return false;
        };






        $( ".dropzone" ).click(function() {
                var id = $(this).attr('id').slice(-1);
                $('#open_browse' + id).trigger('click');
                dropzone_id = '#'+$(this).attr('id');
        });


        $(".input_image_faile").change( function(event) {
            var id = $(this).attr('id').slice(-1);
            var tmppath = URL.createObjectURL(event.target.files[0]);
            $("#dropzone" + id).css("background", "url('" + URL.createObjectURL(event.target.files[0]) + "')");
            
            var upload_image_path = $(this).val();
            var upload_image_path_array=upload_image_path.split('\\');
            var image_name= upload_image_path_array[upload_image_path_array.length - 1];
            
            $("#publicity-image").val(image_name);
        });

    }
});
