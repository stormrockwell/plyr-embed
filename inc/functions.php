<?php

/**
 * Plyr Filter Content
 * Converts plain URLs to videos into Plyr video players.
 * @param  string $content Content to be filtered.
 * @return string          Content with the video URLs replaced with Plyr players.
 */
if ( ! function_exists( 'plyr_filter_content' ) ) {
	function plyr_filter_content( $content ) {
		global $plyr_embed;

		$content = $plyr_embed->replace_urls( $url );

		return $content;
	}
}