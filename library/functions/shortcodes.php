<?php
/*
Example Short Code
http://codex.wordpress.org/Shortcode_API
In WordPress: [blockquote cite="" quote="" author=""][/blockquote]
*/
function wp_arch_blockquote( $atts, $quote = null ) {
    extract(shortcode_atts( array(
        "cite" => '',
        "quote" => '',
        "author" => ''
        ), $atts));
    return '<blockquote cite="'.$cite.'">'.$quote.'<footer><p>'.$author.'</p></footer>'.'</blockquote>';
}
add_shortcode("blockquote", "wp_arch_blockquote");

 ?>
