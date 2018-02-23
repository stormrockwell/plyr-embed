<?php

if ( ! class_exists( 'Plyr_Embed' ) ) {

	class Plyr_Embed {
		public $text_domain = 'plyr-embed';

		/**
		 * Contructor
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_filter( 'the_content', array( $this, 'replace_urls' ), 1 );
		}

		/**
		 * Enqueue Scripts
		 * Registers scripts into WP.
		 *
		 * @return null
		 */
		public function enqueue_scripts() {
			wp_enqueue_style( 'plyr', plugins_url( $this->text_domain . '/assets/css/plyr.css' ), array(), '2.0.18' );
			wp_enqueue_script( 'plyr', plugins_url( $this->text_domain . '/assets/js/plyr.js' ), array(), '2.0.18', true );
			wp_add_inline_script(
				'plyr',
				'plyr.setup();'
			);
		}

		/**
		 * Filter Content
		 * Filters the_content before video url's are parsed by WordPress.
		 *
		 * @param  string $content Content from the WP content editor.
		 * @return string          Updated content with Plyr elements.
		 */
		public function replace_urls( $content ) {

			preg_match_all( '/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|channels\/(?:\w+\/)|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?[\r\n]+/s', $content, $matches );

			foreach ( $matches[0] as $key => $url ) {
				$host = str_replace( '.com', '', $matches[3][ $key ] );
				$host = str_replace( '.be', 'be', $matches[3][ $key ] );
				$elem = $this->get_plyr_elem( $host, $url );

				// Replace the URL with the Plyr element.
				$content = str_replace( $url, $elem, $content );
			}

			return $content;

		}

		/**
		 * Get Plyr Elem
		 * Returns the element Plyr needs to embed the video.
		 *
		 * @param  string $type vimeo or youtube.
		 * @param  string $url  URL to a Vimeo or Youtube video.
		 * @return string       HTML element for Plyr.
		 */
		public function get_plyr_elem( $type, $url ) {
			return '<div data-type="' . esc_attr( $type ) . '" data-video-id="' . esc_url( $url ) . '"></div>';
		}

	}

}
