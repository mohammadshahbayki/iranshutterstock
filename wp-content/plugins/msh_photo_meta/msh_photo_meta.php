<?php
/**
 * Plugin Name:اطلاعات تصویر
 * Author: محمد شاه بیکی
 * Description: ایرن افزونه برای ثبت اطلاعات تصاویر طراحی شده است
 *
 */

//header('Content-Type: image/jpeg');


defined('ABSPATH')||exit;
define('MSHPM_PLUGINS_DIR_URL',plugin_dir_url(__FILE__));
define('MSHPM_PLUGINS_DIR_PATH',plugin_dir_path(__FILE__));
define('MSHPM_LIBS_PATH', MSHPM_PLUGINS_DIR_PATH . 'libraries/');
define('MSHPM_CLASSES_PATH', MSHPM_PLUGINS_DIR_PATH . 'Classes/');
define('MSHPM_ADMIN_VIEW_DIR',MSHPM_PLUGINS_DIR_PATH.'admin/view/');
define('MSHPM_ADMIN_IMAGE_DIR',MSHPM_PLUGINS_DIR_URL.'admin/image/');
define('MSHPM_ADMIN_CSS_DIR',MSHPM_PLUGINS_DIR_URL.'admin/css/');
define('MSHPM_ADMIN_JS_DIR',MSHPM_PLUGINS_DIR_URL.'admin/js/');
define('MSHPM_ADMIN_DIR',MSHPM_PLUGINS_DIR_PATH.'admin/');

require_once(MSHPM_PLUGINS_DIR_PATH.'PHPImageWorkshop/ImageWorkshop.php');
require_once(MSHPM_PLUGINS_DIR_PATH.'PHPImageWorkshop/Exception/ImageWorkshopException.php');
require(MSHPM_PLUGINS_DIR_PATH.'Classes/MSH_Ajax_Handler.php');
new MSH_Ajax_Handler();
include(MSHPM_CLASSES_PATH . 'MSH_Configs.php');
include( MSHPM_CLASSES_PATH . 'MSH_Vafpress.php');
(new MSH_Vafpress())->active();
add_action('wp_head',function(){
    echo '<style type="text/css">
.block {
 display: inline-block;
 width: 300px;
 padding: 10px;
 margin: 10px;
}
.container { width: 160px; }
.grid-item--height2 { height: 140px; }</style>';
});
add_action('init',function(){
    add_shortcode('mshmp_frontpage','mshmp_my_content_show');
});
add_action('wp_enqueue_scripts',function(){
    wp_enqueue_script('masonry_js',MSHPM_ADMIN_JS_DIR.'masonry.pkgd.min.js',array('jquery'));
    wp_enqueue_script('my_masonry_js',MSHPM_ADMIN_JS_DIR.'masonry.js',array('jquery'));
});
add_action('admin_enqueue_scripts', function(){
    wp_register_script('upload.js',MSHPM_ADMIN_JS_DIR.'upload.js',array('jquery'));
    wp_enqueue_script('upload.js');
    wp_localize_script('upload.js', 'myData', array(
        'admin_url'    => admin_url('admin-ajax.php'),
        'image_dir'    =>MSHPM_ADMIN_IMAGE_DIR
    ));
});
function mshmp_my_content_show()
{
    $html='<div class="container"  data-masonry=\'{ "itemSelector": ".grid-item", "columnWidth": 200 }\'>';
    $the_query = new WP_Query('post_type=post&order=desc&posts_per_page=-1');
// The Loop
    if ( $the_query->have_posts() ) {

        while ( $the_query->have_posts() ) {
            $html.= '<div "block">';
            $the_query->the_post();
            $image_id = get_post_meta(get_the_ID(),'_mshmp_photo_id');
            $image_type = get_post_meta(get_the_ID(),'_mshmp_photo_type');
            $html .='<img src="'.MSHPM_PLUGINS_DIR_URL."images-folder/shutterstock_". $image_id[0].'.'.$image_type[0].'"/>';
            $html.=  '</div>';
        }

        /* Restore original Post Data */
        wp_reset_postdata();
    } else {
        // no posts found
    }
    $html .= '</div>';
    return $html;
}
if(is_admin())
{
    require(MSHPM_ADMIN_DIR.'metabox.php');
}
//add_filter('the_content','mshpm_show_content');
//function mshpm_show_content($content)
//{
//    $img='<img src="'. get_post_meta() .'" />'
//    $content=get_post_meta()
//}


//add_action('wp_ajax_nopriv_create_thumbnail', 'myfuncion'); //for all users that logined or not logined
