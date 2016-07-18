<?php

/**
 * Created by PhpStorm.
 * User: FM
 * Date: 16/07/2016
 * Time: 06:38 PM
 */
class MSH_Configs
{
    /**
     * @var Singleton The reference to *Singleton* instance of this class
     */
    private static $instance;

    public $wpdb;

    public $optionKey;

    /**
     * Returns the *Singleton* instance of this class.
     *
     * @return Singleton The *Singleton* instance.
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }


    /**
     * Protected constructor to prevent creating a new instance of the
     * *Singleton* via the `new` operator from outside of this class.
     */
    protected function __construct(){
        global $wpdb;
        $this->wpdb         = $wpdb;

        $this->optionKey    = 'msh_photo_meta_option';
        $this->optionSlug   = 'photo_meta_option';
    }

    public function getOption( $optionName ){
        return function_exists('vp_option') ? vp_option( $this->optionKey . '.' . $optionName ) : get_option($this->optionKey . '_' . $optionName);
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone(){
    }

    /**
     * Private unserialize method to prevent unserializing of the *Singleton*
     * instance.
     *
     * @return void
     */
    private function __wakeup(){
    }
}