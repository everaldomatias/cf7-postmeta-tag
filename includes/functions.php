<?php

namespace CF7GetPostMetaTag;

add_action( 'wpcf7_init', 'CF7GetPostMetaTag\\cf7_add_get_postmeta_tag' );

function cf7_add_get_postmeta_tag() {
    wpcf7_add_form_tag( 'get_postmeta', 'CF7GetPostMetaTag\\cf7_get_postmeta_tag_handler', [ 'name-attr' => true ] );
}

function cf7_get_postmeta_tag_handler( $tag ) {
    $post_id = get_the_ID();
    $meta_key = $tag->name;
    $meta_value = get_post_meta( $post_id, $meta_key, true );

    if ( isset( $tag->values[0] ) ) {
        $default_value = $tag->values[0];
        $meta_value = $meta_value ? $meta_value : $default_value;
    }

    return esc_attr( $meta_value );
}

add_filter( 'wpcf7_special_mail_tags', 'CF7GetPostMetaTag\\_get_postmeta_special_mail_tags', 10, 3 );

function _get_postmeta_special_mail_tags( $output, $name, $html ) {
    $tag_parts = explode( ':', $name );

    if ( strpos( $tag_parts[0], "_get_postmeta" ) === 0 ) {
        $_wpcf7_container_post = isset( $_POST['_wpcf7_container_post'] ) ?? intval( $_POST['_wpcf7_container_post'] );

        $get_post = get_post( $_wpcf7_container_post );

        if ( $get_post && isset( $tag_parts[1] ) ) {
            $output = get_post_meta( $get_post->ID, $tag_parts[1], true );
        }
    }

    return $output;
}

