<?php
$mshmp_photo_source = get_post_meta($post->ID, '_mshmp_photo_source_url', true);
$mshmp_photo_width = get_post_meta($post->ID, '_mshmp_photo_width', true);
$mshmp_photo_height = get_post_meta($post->ID, '_mshmp_photo_height', true);
$mshmp_photo_dpi = get_post_meta($post->ID, '_mshmp_photo_dpi', true);
$mshmp_photo_size = get_post_meta($post->ID, '_mshmp_photo_file_size', true);
$mshmp_photo_size = number_format($mshmp_photo_size/1024,2);
$mshmp_photo_id = get_post_meta($post->ID, '_mshmp_photo_id', true);
$mshmp_photo_type= get_post_meta($post->ID, '_mshmp_photo_type', true);
$mshmp_photo_pos= get_post_meta($post->ID, '_mshmp_photo_position', true);
$mshmp_photo_color = get_post_meta($post->ID, '_mshmp_photo_color', true);
$colors = array(
    'آبی',
    'سبز',
    'قرمز',
    'زرد',
    'نارنجی',
    'قرمز-نارنجی',
    'بنفش',
    'ارغوانی',
    'پرتغالی',
    'سبز-زرد',
    'فیروزه ای',
    'آبی-بنفش',
    'سفید',
    'مشکی',
    'خاکستری',
    'قهوه ای'
);
?>
<div id="mshmp_photo_metabox">
<p>
    <?php
    $pimage = MSHPM_PLUGINS_DIR_URL.'/images-folder/'.'shutterstock_'.$mshmp_photo_id.'.'.$mshmp_photo_type ;
    $pimage_path = MSHPM_PLUGINS_DIR_PATH.'/images-folder/'.'shutterstock_'.$mshmp_photo_id.'.'.$mshmp_photo_type ;
    if(file_exists($pimage_path)){ ?>
    <img src="<?php echo  $pimage ?>"
         <?php } ?>
</p>
    <p>
        <label for="mshmp_txt_photo_source">آدرس تصویر</label>
        <input value="<?php echo $mshmp_photo_source; ?>" class="input_urls widefat ltr" name="mshmp_txt_photo_source"
               id="mshmp_txt_photo_source" type="text">
        <!--        <input  id="mshmp_btn_photo_source" class="button-secondary" type="button" value="انتخاب" name="file_photo_source">-->
    </p>
    <span id="process_circle" style="display: none" class="spinner is-active"></span>
    <!--    <div style="display: none" ><img width="50px" height="50px" src="-->
    <?php //echo MSHPM_ADMIN_IMAGE_DIR.'process.gif'?><!--" > </div>-->
    <p>
        <label for="mshmp_txt_photo_id">شناسه تصویر</label>
        <input id="mshmp_txt_photo_id" name="mshmp_txt_photo_id" class="widefat" value="<?php echo $mshmp_photo_id; ?>" disabled/>
    </p>

    <p>
        <label for="mshmp_txt_photo_width">طول تصویر</label>
        <input id="mshmp_txt_photo_width" name="mshmp_txt_photo_width" class="widefat" value="<?php echo $mshmp_photo_width; ?>" disabled/>
    </p>

    <p>
        <label for="mshmp_txt_photo_height">عرض تصویر</label>
        <input id="mshmp_txt_photo_height" name="mshmp_txt_photo_height" class="widefat" value="<?php echo $mshmp_photo_height; ?>" disabled/>
    </p>

    <p>
        <label for="mshmp_txt_photo_type">نوع تصویر</label>
        <input id="mshmp_txt_photo_type" name="mshmp_txt_photo_type" class="widefat" value="<?php echo $mshmp_photo_type; ?>" disabled/>
    </p>

    <p>
        <label for="mshmp_txt_photo_posture">حالت تصویر</label>
        <input id="mshmp_txt_photo_posture" name="mshmp_txt_photo_posture" class="widefat" value="<?php echo $mshmp_photo_pos; ?>" disabled/>
    </p>

    <p>
        <label for="mshmp_txt_photo_dpi">رزلوشن تصویر</label>
        <input id="mshmp_txt_photo_dpi" name="mshmp_txt_photo_dpi" class="widefat" value="<?php echo $mshmp_photo_dpi; ?>" disabled/>
    </p>

    <p>
        <label for="mshmp_txt_photo_size">اندازه تصویر</label>
        <input id="mshmp_txt_photo_size" name="mshmp_txt_photo_size" class="widefat" value="<?php echo $mshmp_photo_size; ?> کیلو بایت" disabled/>
    </p>
    <p>
        <label for="mshmp_mu_color">بیشترین رنگ بکارفته شده</label>
        <select name="mshpm_color_select" class="widefat" id="mshmp_mu_color">
            <?php for ($i = 0; $i < count($colors); $i++) {
                if ($colors[$i] == $mshmp_photo_color)
                    echo '<option selected>' . $mshmp_photo_color . '</option>';
                else
                    echo '<option>' . $colors[$i] . '</option>';
            }
            ?>
        </select>
    </p>
</div>