<?php
if(!class_exists('GET_PPV_META')){
class GET_PPV_META{
    function __construct(){
        if(is_admin()){
            add_action('wp_ajax_pdfp_get_doc_meta', [$this, 'single_doc_callback']);
        }
    }

    function single_doc_callback(){
        $response = [];
        $id = isset($_GET['id']) ? sanitize_text_field( $_GET['id'] ): false;
        if(!$id){
            return false;
        }

        $data = $this->get_data($id);
        // $video = ['data' => 'no data available'];
       
        echo wp_json_encode($data);
        die();
    }


    public function get_data( $id = 2038){
        $url = self::meta($id, '_groupped_ppv_file_url', '');
        if(is_array($url)){
            $url = $url['url'];
        }else {
            $url = self::meta($id, '_groupped_ppv_ext_url', '');
        }
        $result = [
            'width' => self::meta($id, 'ppt_ppv_width', '100%') == '100%' ? '100%' : self::meta($id, '_groupped_ppv_width', '100%').'px' ,
            'height' => self::meta($id, 'ppt_ppv_height', '600').'px',
            'url' => $url,
            'showName' => self::meta($id, 'ppt_ppv_file_name') == 'on' ? true : false,
            'title' => get_the_title($id)
        ];
        
        return $result;
    }

    public static function meta($id, $key, $default = null){
        if (metadata_exists('post', $id, $key)) {
            $value = get_post_meta($id, $key, true);
            if ($value != '') {
                return $value;
            } else {
                return $default;
            }
        } else {
            return $default;
        }
    }

 
}
new GET_PPV_META();
}