<?php
add_action( 'init', 'ashuwp_buttons' );
function ashuwp_buttons() {
    add_filter( "mce_external_plugins", "ashuwp_add_buttons" );
    add_filter( 'mce_buttons', 'ashuwp_register_buttons' );
}
function ashuwp_add_buttons( $plugin_array ) {
    $plugin_array['line_title'] = get_template_directory_uri() . '/js/line_title.js';
    return $plugin_array;
}
function ashuwp_register_buttons( $buttons ) {
    array_push( $buttons, 'line_title' ); // dropcap', 'recentposts
    return $buttons;
}
?>