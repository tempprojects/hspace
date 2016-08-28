/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
*/

jQuery( document ).ready(function($) {
    
    //console.log($('#dropzone1'));
    var porfolio_result=$(".field-portfolio-images input").val();
    
    if(porfolio_result){
        var images=porfolio_result.split('|');
        $.each(images, function( index, value ) {
            
            if(value){
                //console.log(value);
                //console.log(index);
                $("#dropzone" + index).css("background", "url('http://localhost/yii2_hspace/frontend/web/media/portfolio/" + value + "')");
            }
        });
    }
    
    var dropzone  = document.getElementById('dropzone0');
    var dropzone1 = document.getElementById('dropzone1');
    var dropzone2 = document.getElementById('dropzone2');
    var dropzone_id = '#dropzone0';
    var img_url1 = "";
    var img_url2 = "";
    var img_url3 = "";
    var check_before_save = 0;


    if(dropzone){
        var upload = function(files){
                var formData = new FormData();
                formData.append('file', files[0]);
                var request = $.ajax({
                        data : formData,
                url: 'upload',
                type: 'post',
                dataType: 'html',
                    contentType: false, 
                    processData: false,
            });

            request.done(function( url ) {
                $( dropzone_id ).css('background', 'url('+url+')');
                if(dropzone_id == "#dropzone1"){
                                img_url1 = url;
                }else if( dropzone_id == "#dropzone2" ){
                        img_url2 = url;
                }else if( dropzone_id == "#dropzone3" ){
                        img_url3 = url;
                }
            });

            request.fail(function( jqXHR, textStatus ) {
                alert( textStatus );
            });

        };

        dropzone.ondrop = function(e){
                e.preventDefault();
                var img = $("#dropzone0").find("img");
                if(img.length != 1){
                        this.className = 'dropzone';
                        dropzone_id = '#dropzone0';
                        upload(e.dataTransfer.files);
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


        dropzone1.ondrop = function(e){
                e.preventDefault();
                var img = $("#dropzone1").find("img");
                if(img.length != 1){
                        this.className = 'dropzone';
                        dropzone_id = '#dropzone1';
                        upload(e.dataTransfer.files);
            }
        };

        dropzone1.ondragover = function(){
                this.className = 'dropzone dragover';
                return false;
        };

        dropzone1.ondragleave = function(){
                this.className = 'dropzone';
                return false;
        };

        dropzone2.ondrop = function(e){
                e.preventDefault();
                var img = $("#dropzone2").find("img");
                if(img.length != 1){
                        this.className = 'dropzone';
                        dropzone_id = '#dropzone2';
                        upload(e.dataTransfer.files);
                }
        };

        dropzone2.ondragover = function(){
                this.className = 'dropzone dragover';
                return false;
        };

        dropzone2.ondragleave = function(){
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


            //$("#disp_tmp_path").html("Temporary Path(Copy it and try pasting it in browser address bar) --> <strong>["+tmppath+"]</strong>");
            var porfolio_result=$(".field-portfolio-images input").val();
            var images_array=porfolio_result.split('|');

            var upload_image_path = $(this).val();

            if(upload_image_path){
                var upload_image_path_array=upload_image_path.split('\\');
                var image_name= upload_image_path_array[upload_image_path_array.length - 1];
                images_array[id]=image_name;
                var result_string=images_array.join("|");
                $(".field-portfolio-images input").val(result_string);
                console.log('new string for images ' + result_string);
            }
        });




        //form fo validate corect data in hiden text image field
        $(".portfolio-form form").submit(function(e){
            var porfolio_result=$(".field-portfolio-images input").val();
            var images_array=porfolio_result.split('|');
            var cnt=0;

           //function for count non empty elements
            function logArrayElements(element, index, array) {
                if(element){
                    cnt++;
                }
            }

            images_array.forEach(logArrayElements);
            if(cnt===3){
                return true;
            }
            else{
                console.log('Please, fill all image fields!');
                return false;
            }
        });
    }
});
