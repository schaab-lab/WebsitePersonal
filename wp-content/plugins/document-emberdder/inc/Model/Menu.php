<?php
namespace PPV\Model;

class Menu{
    protected static $_instance = null;

    /**
     * construct function
     */
    public function __construct(){
        add_action('admin_menu', [$this, 'ppv_custom_submenu_page']);
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

    /**
     * Register Submenu
     */
    function ppv_custom_submenu_page() {
        global $submenu;
        
        add_submenu_page( 'edit.php?post_type=ppt_viewer', 'Developer', 'Developer', 'manage_options', 'ppv_submenu_page', [$this, 'ppv_submenu_page_callback'] );

        add_submenu_page( 'edit.php?post_type=ppt_viewer', 'How To Use', 'How To Use', 'manage_options', 'ppv_howto', [$this, 'ppv_howto_page_callback'] );

        $link = 'https://bplugins.page.link/doc-embedder';
        $submenu['edit.php?post_type=ppt_viewer'][] = array( 'PRO Version Demo', 'manage_options', $link, 'meta'=>'target="_blank"' );
    }

    /**
     * Developer menu callback
     */
    function ppv_submenu_page_callback() {
        echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
            echo '<h2>Developer</h2>
            <h2>Md Abu hayat polash</h2>
            <h4>Professional Web Developer (Freelancer)</h4>
            <h5>Web : <a href="http://abuhayatpolash.com">www.abuhayatpolash.com</h5></a>
            <h5>Hire Me : <a target="_blank" href="https://www.upwork.com/freelancers/~01c73e1e24504a195e">On Upwork.com</h5>
            Email: <a href="mailto:support@bplugins.com">support@bplugins.com </a>
            <h5>Skype: ah_polash</h5> 
            <br />
            
            ';
        echo '</div>';
    
    }

    /**
     * How to menu callback
     */
    function ppv_howto_page_callback() {
        
        echo "<div class='wrap'><div id='icon-tools' class='icon32'></div>";
            echo "<h2>How to use ? </h2>
                <h2>We made a movie for you ! Watch it and learn. </h2>
                <br/>
                <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 85%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe src='https://www.youtube.com/embed//mUlMpuPMP5Q' frameborder='0' allowfullscreen></iframe></div>
                <br />
            ";
        echo '</div>';
    }
}
Menu::instance();