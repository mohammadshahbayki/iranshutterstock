<?php
use PHPImageWorkshop\ImageWorkshop;

//wp_die(MSHPM_PLUGINS_DIR_PATH.'PHPImageWorkshop\ImageWorkshop.php');
//

//wp_register_style('my_admin_style',MSHPM_ADMIN_CSS_DIR.'admin_style.css');
//wp_enqueue_style('my_admin_style')

add_action('add_meta_boxes','mshmp_add_photo_metabox');
add_action('save_post','mshmp_save_meta_info');
add_action('save_edit','mshmp_save_meta_info');
add_action('init','mshmp_register_taxonomy');
function mshmp_add_photo_metabox()
{
    add_meta_box('mshpm_photo_information',
        'اطلاعات تصویر',
        function($post){include(MSHPM_ADMIN_VIEW_DIR.'mshpm_metabox_echo.php');},
        'post',
        'advanced'
    );
}
function get_dpi($filename){
    // open the file and read first 20 bytes.
    $a = fopen($filename,'r');
    $string = fread($a,20);
    fclose($a);

    // get the value of byte 14th up to 18th
    $data = bin2hex(substr($string,14,4));
    $x = substr($data,0,4);
    $y = substr($data,4,4);
    return array(hexdec($x),hexdec($y));
}
function mshmp_save_meta_info($post_id)
{
    if(!isset($_POST['mshmp_txt_photo_source']))
    {
        return;
    }
//start picture size
    $url= MSH_Configs::getInstance()->getOption('prefix_url');
    $url .= '/';
    $url .= $_POST['mshmp_txt_photo_source'];
    $url = esc_url_raw($url);
    list($width, $height,$type,$attr)=getimagesize($url);
    $imageTypeArray = array
    (
        0=>'UNKNOWN',
        1=>'GIF',
        2=>'JPEG',
        3=>'PNG',
        4=>'SWF',
        5=>'PSD',
        6=>'BMP',
        7=>'TIFF_II',
        8=>'TIFF_MM',
        9=>'JPC',
        10=>'JP2',
        11=>'JPX',
        12=>'JB2',
        13=>'SWC',
        14=>'IFF',
        15=>'WBMP',
        16=>'XBM',
        17=>'ICO',
        18=>'COUNT'
    );
    $size = getimagesize($url);
    $type = $imageTypeArray[$size[2]];
    $pos=($width>=$height)?'افقی':'عمودی';
    $img_size = get_headers($url, 1);
    $img_size = $img_size["Content-Length"];
//  $layer = ImageWorkshop::initFromResourceVar($image);
    $img_dpi = get_dpi($url);
// end picture size
// explode url
    $url_data= explode('/',$url);
    $image_title = $url_data[count($url_data)-1];
    $image_id_array=explode('_',$image_title);
    $image_id = explode('.' , $image_id_array[count($image_id_array)-1])[0];
//end explode
    update_post_meta($post_id,'_mshmp_photo_width',$width);
    update_post_meta($post_id,'_mshmp_photo_height',$height);
    update_post_meta($post_id,'_mshmp_photo_type',$type);
    update_post_meta($post_id,'_mshmp_photo_position',$pos);
    update_post_meta($post_id,'_mshmp_photo_file_size',$img_size);
    update_post_meta($post_id,'_mshmp_photo_dpi',$img_dpi[0]);
    update_post_meta($post_id,'_mshmp_photo_id',$image_id);
    update_post_meta($post_id,'_mshmp_photo_title',$image_title);
    update_post_meta($post_id, '_mshmp_photo_source_url', $_POST['mshmp_txt_photo_source']);
    update_post_meta($post_id,'_mshmp_photo_color',sanitize_text_field($_POST['mshpm_color_select']) );
    //save thumbnail
//    makeThumbnails(MSHPM_PLUGINS_DIR_URL,$image,$post_id,$width,$height,$size[2]);
    if ($width > $height) {
        $new_width = 189 ;
        $new_height = 134;
    } else {
        $new_height = 189;
        $new_width =134;
    }
    $pimage_path = MSHPM_PLUGINS_DIR_PATH.'/images-folder/'.'shutterstock_'.$image_id.'.'.$type ;
   if(file_exists($pimage_path)) $t=filemtime($pimage_path);
    if(!file_exists($pimage_path)||$t>$t+3600)
    {
        $Layer = ImageWorkshop::initFromPath($url);
        $Layer->resizeInPixel(($width/$height)*300, 300, true, 0, 0, 'MM');
//    $Layer->resizeInPercent(10,10);
        $textLayer = ImageWorkshop::initTextLayer('© IRAN SHUTTERSTOCK',MSHPM_PLUGINS_DIR_PATH.'/admin/fonts/terran3dital.ttf' , 22, 'ffffff', calculAngleBtwHypoAndLeftSide($Layer->getWidth(), $Layer->getHeight()));
// Some funky opacity
        $textLayer->opacity(40);
// We add the $textLayer on the norway layer, in its middle
        $Layer->addLayer(1, $textLayer, 0, 0, 'MM');
        $folder = MSHPM_PLUGINS_DIR_PATH."images-folder";
        $file_name ="shutterstock_".$image_id.".".$type;
        $Layer->save($folder,$file_name);
    }
}
function calculAngleBtwHypoAndLeftSide($bottomSideWidth, $leftSideWidth)
{
    $hypothenuse = sqrt(pow($bottomSideWidth, 2) + pow($leftSideWidth, 2));
    $bottomRightAngle = acos($bottomSideWidth / $hypothenuse) + 180 / pi();
    return -round(90 - $bottomRightAngle);
}
//Taxonomy
function mshmp_register_taxonomy()
{
    $args= array('show_ui'=>true,
            'labels'    => array(
            'name'                       => 'نوع',
            'singular_name'              => 'نوع',
            'search_items'               => 'جستجوی نوع',
            'popular_items'              => 'نوع های معروف',
            'all_items'                  => 'تمامی نوع ها',
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => 'ویرایش نوع',
            'update_item'                => 'ویرایش نوع',
            'add_new_item'               => 'افزودن نوع جدید  ',
            'new_item_name'              => 'نوع جدید',
            'separate_items_with_commas' => 'جدا سازی نوع ها بوسیله کاما',
            'add_or_remove_items'        => 'افزودن یا حذف نوع',
            'choose_from_most_used'      => 'از نوعی که بیشتر استفاده شده',
            'not_found'                  => 'نوعی یافت نشد',
            'menu_name'                  => 'نوع محصول',
        ),
        'hierarchical'                      => true,
        );
    register_taxonomy('product_type',array('post'),$args);
}
