<?php

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Word Count Main Class
 */
class Word_Count {
    public function __construct() {

        add_filter( 'the_content', [$this, 'wp_post_word_count'] );
    }

    /**
     * Word Count Render Function
     *
     * @param  string   $post_content
     * @return string
     */
    public function wp_post_word_count( $post_content ) {

        $stripped_content = strip_tags( $post_content );
        $word_number      = str_word_count( $stripped_content );

        $before_label = apply_filters( "wp_post_word_counts_before_text", __( 'Total Number of Words:', 'word-count' ) );
        $after_label  = apply_filters( "wp_post_word_counts_after_text", '' );
        $html_tag     = apply_filters( 'wp_post_word_counts_html_tag', 'h3' );

        $is_visible = apply_filters( 'wp_post_word_counts_is_visible', true );

        $text_content = sprintf( '%1$s %2$s %3$s', $before_label, $word_number, $after_label );

        if ( $is_visible ) {
            $post_content .= sprintf( '<%1$s> %2$s </%3$s>', $html_tag, $text_content, $html_tag );
        }

        return $post_content;
    }
}