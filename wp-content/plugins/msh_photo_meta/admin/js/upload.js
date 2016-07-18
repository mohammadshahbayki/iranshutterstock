jQuery(document).ready(function($){
    $('#mshmp_btn_photo_source').click(function(){
        renderMediaUploader();
    });
    function renderMediaUploader() {
        'use strict';
        var file_frame;
        if ( undefined !== file_frame ) {
            file_frame.open();
            return;
        }
        file_frame = wp.media.frames.file_frame = wp.media({
            frame   : 'post',
            state   : 'insert',
            library : {
                type: 'image',
            },
            multiple: false
        });
        file_frame.on( 'insert', function() {

            var selection = file_frame.state().get('selection').first().toJSON();
                    var url = selection.url;
                    $('#mshmp_txt_photo_source').val(url);
        });
        file_frame.open();
    }
    $('.input_urls').blur(function(){
       var url = $('.input_urls').val();
        fill_attr(url);
    });
    function fill_attr(url){
        $.ajax({
            type: 'POST',
            url : myData.admin_url,
            data: {
                action:'create_thumbnail',
                pic_url:url
            },
            success: function(data){
                $('#mshmp_txt_photo_width').val(data.width);
                $('#mshmp_txt_photo_height').val(data.height);
                $('#mshmp_txt_photo_size').val(data.size+'  '+'کیلو بایت');
                $('#mshmp_txt_photo_dpi').val(data.dpi);
                $('#mshmp_txt_photo_id').val(data.image_id);
                $('#mshmp_txt_photo_type').val(data.type);
                $('#mshmp_txt_photo_posture').val(data.pos);
                $('#postimagediv .inside').html(data.thumbnail);
                console.log(data);
            },
            beforeSend: function(){
                $('#process_circle').css('display','');
                $('#postimagediv .inside').html('<div ><img width="50px" height="50px" src="'+myData.image_dir+'process.gif' +'"> </div>');
            },
            complete: function(){
                $('#process_circle').css('display','none');
            },
            error: function(){
            }
        });
    }
    //
    //$('.grid').masonry({
    //    itemSelector: '.grid-item',
    //    columnWidth: 160
    //});
});