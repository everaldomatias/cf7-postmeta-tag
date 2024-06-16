<?php

namespace CF7PostmetaTag;

add_action( 'wp_enqueue_scripts', 'CF7PostmetaTag\\frontend_enqueue_scripts' );

function frontend_enqueue_scripts() {
    wp_enqueue_style( 'cf7-postmeta-tag-style', CF7_POSTMETA_TAG_PATH . 'dist/style.css', [], CF7_POSTMETA_TAG_VERSION, 'all' );
    // wp_enqueue_script( 'cf7-postmeta-tag-script', CF7_POSTMETA_TAG_PATH . 'dist/main.js', [], CF7_POSTMETA_TAG_VERSION, true );
}
