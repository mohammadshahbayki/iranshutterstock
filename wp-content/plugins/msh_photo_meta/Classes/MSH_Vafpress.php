<?php

/**
 * Created by PhpStorm.
 * User: FM
 * Date: 16/07/2016
 * Time: 06:26 PM
 */
class MSH_Vafpress
{
    public function __construct() {
        if( !class_exists('VP_Option') ){
            require_once(MSHPM_LIBS_PATH . 'vafpress-framework/bootstrap.php');
        }
        //VP_Security::instance()->whitelist_function(array(&$this, 'vp_get_new_posts'));
    }
    public function active(){
        /**
         * Create instance of Options
         */
        $theme_options = new VP_Option(array(
            'is_dev_mode'           => false,                                  // dev mode, default to false
            'option_key'            => MSH_Configs::getInstance()->optionKey,                           // options key in db, required
            'page_slug'             => MSH_Configs::getInstance()->optionSlug,                           // options page slug, required
            'template'              => array(
                'title'     => 'تنطیمات',
                //'logo'      => DYEDD_IMG . 'logo-daneshjooyar.png',
                'logo_link' => home_url(),
                'menus'     => array(
//                    array(
//                        'title'     => 'تنظیمات منوها',
//                        'name'      => 'public_settings',
//                        'icon'      => 'fontawesome:icon-glide',
//                        'controls'  => array(
//                            array(
//                                'type'      => 'toggle',
//                                'name'      => 'show_mellat_menu',
//                                'label'     => 'نسخه طلایی بانک ملت',
//                                'default'   => '1'
//                            ),
//                            array(
//                                'type'      => 'toggle',
//                                'name'      => 'show_persian_wordpress',
//                                'label'     => 'نسخه وردپرس فارسی',
//                                'default'   => '1'
//                            ),
//                            array(
//                                'type'      => 'toggle',
//                                'name'      => 'show_tools',
//                                'label'     => 'ابزارها',
//                                'default'   => '1'
//                            ),
//                        )
//                    ),
                    array(
                        'title' => 'تنظیمات مدیر',
                        'name'  => 'main_page_settings',
                        'icon'  => '',
                        'menus' => array(
                            array(//New => start
                                'title'     => 'آدرس هاست تصاویر',
                                'name'      => 'newest',
                                'icon'      => 'fontawesome:icon-glide',
                                'controls'  => array(
                                    array(
                                        'type'      => 'textbox',
                                        'name'      => 'prefix_url',
                                        'label'     => 'آدرس پیشوند',
                                        'validation'=> 'url|required',
                                        'default'   => home_url(),
                                        'style'     => array(
                                            'direction' => 'ltr',
                                            'text-align'=> 'left',
                                        )
                                    ),
                                )
                            ),//New => end
//                            array(//Top sell => start
//                                'title'     => 'پرطرفدار ترین ها',
//                                'name'      => 'top_sell',
//                                'icon'      => 'fontawesome:icon-glide',
//                                'controls'  => array(
//                                    array(
//                                        'type'      => 'multiselect',
//                                        'name'      => 'exclude_from_topsell',
//                                        'label'     => 'حذف از این بخش',
//                                        'items' => array(
//                                            'data' => array(
//                                                array(
//                                                    'source' => 'function',
//                                                    'value' => array(&$this, 'vp_get_new_posts'),
//                                                )
//                                            )
//                                        ),
//                                    ),
//                                    array(
//                                        'type'      => 'textbox',
//                                        'name'      => 'topsell_show_count',
//                                        'label'     => 'تعداد نمایش',
//                                        'validation'=> 'numeric|required',
//                                        'default'   => 8,
//                                    ),
//                                )
//                            ),//Top sell => end
//                            array(//csharp => start
//                                'title'     => 'سی شارپ',
//                                'name'      => 'csharp',
//                                'icon'      => 'fontawesome:icon-glide',
//                                'controls'  => array(
//                                    array(
//                                        'type'      => 'multiselect',
//                                        'name'      => 'exclude_from_csharp',
//                                        'label'     => 'حذف از این بخش',
//                                        'items' => array(
//                                            'data' => array(
//                                                array(
//                                                    'source' => 'function',
//                                                    'value' => array(&$this, 'vp_get_new_posts'),
//                                                )
//                                            )
//                                        ),
//                                    ),
//                                    array(
//                                        'type'      => 'textbox',
//                                        'name'      => 'csharp_show_count',
//                                        'label'     => 'تعداد نمایش',
//                                        'validation'=> 'numeric|required',
//                                        'default'   => 4,
//                                    ),
//                                )
//                            ),//csharp => end
//                            array(//php => start
//                                'title'     => 'پی اچ پی',
//                                'name'      => 'php',
//                                'icon'      => 'fontawesome:icon-glide',
//                                'controls'  => array(
//                                    array(
//                                        'type'      => 'multiselect',
//                                        'name'      => 'exclude_from_php',
//                                        'label'     => 'حذف از این بخش',
//                                        'items' => array(
//                                            'data' => array(
//                                                array(
//                                                    'source' => 'function',
//                                                    'value' => array(&$this, 'vp_get_new_posts'),
//                                                )
//                                            )
//                                        ),
//                                    ),
//                                    array(
//                                        'type'      => 'textbox',
//                                        'name'      => 'php_show_count',
//                                        'label'     => 'تعداد نمایش',
//                                        'validation'=> 'numeric|required',
//                                        'default'   => 4,
//                                    ),
//                                )
//                            ),//php => end
//                            array(//asp => start
//                                'title'     => 'ASP.Net',
//                                'name'      => 'asp',
//                                'icon'      => 'fontawesome:icon-glide',
//                                'controls'  => array(
//                                    array(
//                                        'type'      => 'multiselect',
//                                        'name'      => 'exclude_from_asp',
//                                        'label'     => 'حذف از این بخش',
//                                        'items' => array(
//                                            'data' => array(
//                                                array(
//                                                    'source' => 'function',
//                                                    'value' => array(&$this, 'vp_get_new_posts'),
//                                                )
//                                            )
//                                        ),
//                                    ),
//                                    array(
//                                        'type'      => 'textbox',
//                                        'name'      => 'asp_show_count',
//                                        'label'     => 'تعداد نمایش',
//                                        'validation'=> 'numeric|required',
//                                        'default'   => 4,
//                                    ),
//                                )
//                            ),//asp => end
//                            array(//android => start
//                                'title'     => 'اندروید',
//                                'name'      => 'android',
//                                'icon'      => 'fontawesome:icon-glide',
//                                'controls'  => array(
//                                    array(
//                                        'type'      => 'multiselect',
//                                        'name'      => 'exclude_from_android',
//                                        'label'     => 'حذف از این بخش',
//                                        'items' => array(
//                                            'data' => array(
//                                                array(
//                                                    'source' => 'function',
//                                                    'value' => array(&$this, 'vp_get_new_posts'),
//                                                )
//                                            )
//                                        ),
//                                    ),
//                                    array(
//                                        'type'      => 'textbox',
//                                        'name'      => 'android_show_count',
//                                        'label'     => 'تعداد نمایش',
//                                        'validation'=> 'numeric|required',
//                                        'default'   => 4,
//                                    ),
//                                )
//                            ),//android => end
//                            array(
//                                'title'     => 'سایر تنظیمات',
//                                'name'      => 'main_other_settings',
//                                'icon'      => 'fontawesome:icon-glide',
//                                'controls'  => array(
//                                    array(
//                                        'type'      => 'toggle',
//                                        'name'      => 'show_advertise',
//                                        'label'     => 'نمایش تبلیغات',
//                                        'default'   => '1',
//                                    ),
//                                    array(
//                                        'type'          => 'textbox',
//                                        'name'          => 'total_time_course',
//                                        'label'         => 'متن تعداد کل زمان دوره ها',
//                                        'description'   => 'مثال: بیش از ۱۰ هزار ساعت ویدئوی آموزشی',
//                                        'default'       => 'بیش از ۱۰ هزار ساعت ویدئوی آموزشی',
//                                        'validation'    => 'required',
//                                    ),
//                                    array(
//                                        'type'          => 'textbox',
//                                        'name'          => 'total_students',
//                                        'label'         => 'متن تعداد کل دانشجویان',
//                                        'description'   => 'مثال: بیش از ۵۰ هزار دانشجو',
//                                        'default'       => 'بیش از ۵۰ هزار دانشجو',
//                                        'validation'    => 'required',
//                                    ),
//                                    array(
//                                        'type'          => 'textbox',
//                                        'name'          => 'total_teachers',
//                                        'label'         => 'متن تعداد کل مدرسین',
//                                        'description'   => 'مثال: بیش از ۳۰۰ مدرس',
//                                        'default'       => 'بیش از ۳۰۰ مدرس',
//                                        'validation'    => 'required',
//                                    ),
//                                    array(
//                                        'type'          => 'textbox',
//                                        'name'          => 'main_page_title',
//                                        'label'         => 'متن موجود در هدر',
//                                        'default'       => 'چه دوره ای می خواهید یاد بگیرید؟',
//                                        'validation'    => 'required',
//                                    ),
//                                    array(
//                                        'type'          => 'textbox',
//                                        'name'          => 'main_page_subtitle',
//                                        'label'         => 'زیر متن موجود در هدر',
//                                        'default'       => 'آینده خود را با دوره های آموزشی دانشجویار تضمین کنید',
//                                        'validation'    => 'required',
//                                    ),
//                                )
//                            ),
                        ),
                    )
                ),
            ),                              // template file path or array, required
            'menu_page'             => 'options-general.php',                           // parent menu slug or supply `array` (can contains 'icon_url' & 'position') for top level menu
            'use_auto_group_naming' => true,                                   // default to true
            'use_util_menu'         => true,                                   // default to true, shows utility menu
            'minimum_role'          => 'manage_options',                   // default to 'edit_theme_options'
            'layout'                => 'fixed',                                // fluid or fixed, default to fixed
            'page_title'            => 'تنظیمات ویژه', // page title
            'menu_label'            => 'تنظیمات ویژه', // menu label
        ));
    }

    public function vp_get_new_posts(){
        global $wpdb;
        $posts = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish'");

        $result = array();
        foreach ($posts as $post)
        {
            $result[] = array('value' => $post->ID, 'label' => $post->post_title);
        }
        return $result;
    }
}