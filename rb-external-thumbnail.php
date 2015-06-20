<?php
/*
 * Plugin Name: RB External Thumbnail
 * Plugin URI: https://github.com/rodrigo-brito/rb-external-thumbnail
 * Description: External images for post thumbnail.
 * Author: Rodrigo Brito
 * Version: 1.0
 * Author URI: http://www.rodrigobrito.net/
 */



require_once plugin_dir_path( __FILE__ ).'inc/class-metabox.php';

register_activation_hook(__FILE__, 'rb_thumbnail_install');
register_deactivation_hook(__FILE__, 'rb_thumbnail_uninstall');


function rb_thumbnail_install() {

}


function rb_thumbnail_uninstall() {
    delete_post_meta_by_key( 'thumbnail_external' );
}

$thumbnail_metabox = new RB_Thumbnail_Metabox(
    'thumbnail_external',
    'Thumbnail externo',
    'post',
    'normal',
    'high'
);

$thumbnail_metabox->set_fields(
    array(
        array(
            'id'          => 'thumbnail_external',
            'label'       => 'Image URL',
            'type'        => 'text',
            'attributes'  => array(
                'placeholder' => __( 'Ex: http://www.site.com/imagem.jpg' )
            )
        )
    )
);

add_filter( 'post_thumbnail_html', 'external_post_thumbnail_html' );

function external_post_thumbnail_html( $html ) {
    global $post;
    $thumbnail = get_post_meta( $post->ID ,'thumbnail_external', true );
    if ( empty( $html ) )
        $html = '<img src="' . $thumbnail . '" />';

    return $html;
}

?>