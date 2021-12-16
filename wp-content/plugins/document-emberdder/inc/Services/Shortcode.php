<?php
namespace PPV\Model;
use PPV\Model\AnalogSystem;

class Shortcode{
    protected static $_instance = null;

    /**
     * construct function
     */
    public function __construct(){
        add_shortcode('doc', [$this, 'doc']);
    }

    /**
     * Create instance function
     */
    public static function instance(){
        if(self::$_instance === null){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function doc($atts){
        $post_type = get_post_type($atts['id']);
        if($post_type != 'ppt_viewer'){
            return false;
        }
        ob_start();

        echo AnalogSystem::html($atts['id']);

        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }
}
Shortcode::instance();

// add_action('init', function(){
//     if(current_user_can('manage_options')){
//         echo true;
//     }else {
//         echo false;
//     }
//     // echo true;
//     // echo "noting";
// });