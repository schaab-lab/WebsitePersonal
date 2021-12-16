<?php
namespace PPV\Model;

class Metabox{
    protected static $_instance = null;

    /**
     * construct function
     */
    public function __construct(){
        if(!defined('PPV_PRO_PLUGIN')){
            add_action( 'add_meta_boxes', [$this, 'ppv_myplugin_add_meta_box'] );
        }
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

    function ppv_myplugin_add_meta_box() {
        add_meta_box(
            'donation',
            __( 'Upgrade to Pro', 'myplugin_textdomain' ),
            [$this, 'ppv_callback_donation'],
            'ppt_viewer'
        );	
        add_meta_box(
            'myplugin_sectionid',
            __( 'Try LightBox Addons', 'myplugin_textdomain' ),
            [$this, 'ppv_addons_callback'],
            'ppt_viewer',
            'side'
        );
        add_meta_box(
            'ppv_sectionid',
            __( 'Get The Pro For Free', 'myplugin_textdomain' ),
            [$this, 'ppv_follow_me_callback'],
            'ppt_viewer',
            'side'
        );		
    }

    function ppv_callback_donation( ) {
        echo '
    <script src="https://gumroad.com/js/gumroad-embed.js"></script>
    <div class="gumroad-product-embed" data-gumroad-product-id="depro" data-outbound-embed="true"><a target="_blank" href="https://gumroad.com/l/depro">Loading...</a></div>
    ';}
    function ppv_addons_callback(){
        echo'<a target="_blank" href="https://app.gumroad.com/l/nAiet"><img style="width:100%" src="'.PPV_PLUGIN_DIR.'/img/upwork.png" ></a>
    <p>LightBox Addons enable you to open any doc in a Nice LightBox</p>
    <table>
        <tr>
            <td><a class="button button-primary button-large" href="https://bplugins.com/demo/lightbox-addons-demo/" target="_blank">See Demo </a></td>
            <td><a class="button button-primary button-large" href="https://gumroad.com/l/lightB" target="_blank">Buy Now</a></td>
        </tr>
    </table>
    ';}
    
    
    function ppv_follow_me_callback( ) {
        echo'
        <ul style="list-style-type: square;padding-left:10px;">
            <li><a href="https://wordpress.org/support/plugin/document-emberdder/reviews/?filter=5#new-post" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733; Rate </a> <strong>Document Embedder</strong> Plugin</li>
            <li>Take a screenshot along with your name and the comment. </li>
            <li><a href="mailto:pluginsfeedback@gmail.com">Email us</a> ( pluginsfeedback@gmail.com ) the screenshot.</li>
            <li>You will receive a promo Code of 100% Off.</li>
        </ul>	
        Your Review is very important to us as it helps us to grow more.</p>
    
        <p>Not happy, Sorry for that. You can request for improvement. </p>
    
        <table>
            <tr>
                <td><a class="button button-primary button-large" href="https://wordpress.org/support/plugin/embed-office-viewer/reviews/?filter=5#new-post" target="_blank">Write Review</a></td>
                <td><a class="button button-primary button-large" href="mailto:support@bplugins.com" target="_blank">Request Improvement</a></td>
            </tr>
        </table>
    
    '; }
}
Metabox::instance();