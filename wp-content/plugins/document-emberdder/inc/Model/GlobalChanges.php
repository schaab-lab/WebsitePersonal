<?php
namespace PPV\Model;

class GlobalChanges{
    protected static $_instance = null;

    /**
     * construct function
     */
    public function __construct(){
        
        if(is_admin()){
            add_filter('post_row_actions', [$this, 'removeRowAction'], 10, 2);
            add_action('admin_head-post.php', [$this, 'ppv_hide_publishing_actions']);
            add_action('admin_head-post-new.php', [$this, 'ppv_hide_publishing_actions']);
            add_filter( 'gettext', [$this, 'ppv_change_publish_button'], 10, 2 );
            add_action( 'admin_head', [$this, 'ppv_my_custom_script'] );
            add_action( 'wp_dashboard_setup', [$this, 'ppv_add_dashboard_widgets'] );
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

    /*-------------------------------------------------------------------------------*/
    /*   Hide & Disabled View, Quick Edit and Preview Button
    /*-------------------------------------------------------------------------------*/
    public function removeRowAction($row){
        global $post;
        if ($post->post_type == 'ppt_viewer') {
            unset($row['view']);
            unset($row['inline hide-if-no-js']);
        }
        return $row;
    }

    /*-------------------------------------------------------------------------------*/
    /* HIDE everything in PUBLISH metabox except Move to Trash & PUBLISH button
    /*-------------------------------------------------------------------------------*/
    function ppv_hide_publishing_actions(){
        $my_post_type = 'ppt_viewer';
        global $post;
        if($post->post_type == $my_post_type){
            echo '
                <style type="text/css">
                    #misc-publishing-actions,
                    #minor-publishing-actions{
                        display:none;
                    }
                </style>
            ';
        }
    }

    
    /*-------------------------------------------------------------------------------*/
    /* Change publish button to save.
    /*-------------------------------------------------------------------------------*/
    function ppv_change_publish_button( $translation, $text ) {
        if ( 'ppt_viewer' == get_post_type())
        if ( $text == 'Publish' )
            return 'Save';

        return $translation;
    }

    /**
     * Inject script in admin head
     */
    function ppv_my_custom_script() {
        $screen = get_current_screen();
		if($screen->post_type === 'ppt_viewer'){
			?>
            <script type="text/javascript">
                jQuery(document).ready( function($) {
                    $( "ul#adminmenu a[href$='https://bplugins.page.link/doc-embedder']" ).attr( 'target', '_blank' );
                });
            </script>
            <?php
		}
    }

    function ppv_add_dashboard_widgets() {
        wp_add_dashboard_widget( 'ppv_example_dashboard_widget', 'Get The PRO For Free', [$this, 'ppv_dashboard_widget_function'] );
    
        global $wp_meta_boxes;
        $normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
        $example_widget_backup = array( 'ppv_example_dashboard_widget' => $normal_dashboard['ppv_example_dashboard_widget'] );
        unset( $normal_dashboard['ppv_example_dashboard_widget'] );
       $sorted_dashboard = array_merge( $example_widget_backup, $normal_dashboard );
        $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
   }


   function ppv_dashboard_widget_function() {
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
       </table>'; 
    }
}
GlobalChanges::instance();