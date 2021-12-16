<?php
// Control core classes for avoid errors
add_action('plugins_loaded', function(){
  if( class_exists( 'CSF' ) ) {

    //
    // Set a unique slug-like ID
    $prefix = 'ppv';
  
    //
    // Create a metabox
    CSF::createMetabox( $prefix, array(
      'title'     => 'Configuration',
      'post_type' => 'ppt_viewer',
    ) );
  
    //
    // Create a section
    CSF::createSection( $prefix, array(
      'title'  => '',
      'fields' => apply_filters( 'ppv_pro_metabox', array(
        array(
          'id'    => 'doc',
          'type'  => 'upload',
          'title' => 'Document',
        ),
        array(
            'id' => 'width',
            'type' => 'dimensions',
            'title' => 'Width',
            'height' => false,
            'default' => ['width' => '100', 'unit' => '%']
        ),
        array(
            'id' => 'height',
            'type' => 'dimensions',
            'title' => 'Height',
            'width' => false,
            'default' => ['height' => 600, 'unit' => 'px']
        ),
        array(
            'id' => 'showName',
            'type' => 'switcher',
            'title' => 'Show file name on top',
            'default' => 0
        )
        
        ) )
    ) );
}  
});