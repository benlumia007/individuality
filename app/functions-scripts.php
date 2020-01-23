<?php
/**
 * Individuality ( functions-scripts.php )
 *
 * @package     Individuality
 * @copyright   Copyright (C) 2019. Benjamin Lu
 * @license     GNU General Public License v2 or later ( https://www.gnu.org/licenses/gpl-2.0.html )
 * @author      Benjamin Lu ( https://luthemes.com )
 */

/**
 * Define namespace
 */
namespace Individuality;

/**
 * Enqueue Scripts and Styles
 *
 * @since  1.0.0
 * @access public
 * @return void
 *
 * @link   https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @link   https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		/**
		 * This is the main stylesheet that is being enqueue. This should be used rather than using @import stylesheets.
		 */
		wp_enqueue_style( 'individuality-style', get_stylesheet_uri(), array(), '1.0.0' );

		/**
		 * This allows users to comment by clicking on reply so that it gets nested.
		 */
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
);

add_action(
	'wp_enqueue_scripts',
	function() {
		$text_color = get_header_textcolor();
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $text_color ) {
			return;
		}
		$value      = display_header_text() ? sprintf( 'color: #%s', esc_html( $text_color ) ) : 'display: none;';
		$custom_css = "
			.site-branding .site-title a,
			.site-description {
				{$value}
			}
		";
		wp_add_inline_style( 'individuality-style', $custom_css );
	}
);

add_action(
	'enqueue_block_editor_assets',
	function() {
		wp_enqueue_style( 'individuality-block-fonts', get_theme_file_uri( '/vendor/benlumia007/backdrop-core/assets/fonts/custom-fonts.css' ), array(), '1.0.0' );
	}
);