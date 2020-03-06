<?php
/**
 * The Yoast Block Converter.
 *
 * @since      1.0.37
 * @package    RankMath
 * @subpackage RankMath\Status
 * @author     Rank Math <support@rankmath.com>
 */

namespace RankMath\Status;

use RankMath\Helper;
use RankMath\Traits\Hooker;

/**
 * Yoast_Blocks class.
 */
class Yoast_Blocks extends \WP_Background_Process {

	/**
	 * FAQ Converter.
	 *
	 * @var Yoast_FAQ_Converter
	 */
	private $faq_converter;

	/**
	 * Action.
	 *
	 * @var string
	 */
	protected $action = 'convert_yoast_blocks';

	/**
	 * Main instance
	 *
	 * Ensure only one instance is loaded or can be loaded.
	 *
	 * @return Yoast_Blocks
	 */
	public static function get() {
		static $instance;

		if ( is_null( $instance ) && ! ( $instance instanceof Yoast_Blocks ) ) {
			$instance = new Yoast_Blocks;
		}

		return $instance;
	}

	/**
	 * Start creating batches.
	 *
	 * @param [type] $posts [description].
	 */
	public function start( $posts ) {
		$chunks = array_chunk( $posts, 10 );
		foreach ( $chunks as $chunk ) {
			$this->push_to_queue( $chunk );
		}

		$this->save()->dispatch();
	}

	/**
	 * Task to perform
	 *
	 * @param string $posts Posts to process.
	 */
	public function wizard( $posts ) {
		$this->task( $posts );
	}

	/**
	 * Task to perform
	 *
	 * @param string $posts Posts to process.
	 *
	 * @return bool
	 */
	protected function task( $posts ) {
		try {
			$this->faq_converter = new Yoast_FAQ_Converter;
			foreach ( $posts as $post_id ) {
				$post = get_post( $post_id );
				$this->convert( $post );
			}
			return false;
		} catch ( Exception $error ) {
			return true;
		}
	}

	/**
	 * Convert post.
	 *
	 * @param [type] $post [description].
	 */
	public function convert( $post ) {
		$dirty  = false;
		$blocks = $this->parse_blocks( $post->post_content );

		$content = '';
		if ( isset( $blocks['yoast/faq-block'] ) && ! empty( $blocks['yoast/faq-block'] ) ) {
			$dirty   = true;
			$content = $this->faq_converter->replace( $post->post_content, $blocks['yoast/faq-block'] );
		}

		if ( $dirty ) {
			$post->post_content = $content;
			wp_update_post( $post );
		}
	}

	/**
	 * Find posts with yoast blocks.
	 *
	 * @return array
	 */
	public function find_posts() {
		$args  = [
			's'             => 'wp:yoast/faq-block',
			'post_status'   => 'any',
			'numberposts'   => -1,
			'fields'        => 'ids',
			'no_found_rows' => true,
		];
		$posts = get_posts( $args );

		return $posts;
	}

	/**
	 * Parse blocks to get data.
	 *
	 * @param string $content Post content to parse.
	 *
	 * @return array
	 */
	private function parse_blocks( $content ) {
		$parsed_blocks = parse_blocks( $content );

		$blocks = [];
		foreach ( $parsed_blocks as $block ) {
			if ( empty( $block['blockName'] ) ) {
				continue;
			}

			$name = strtolower( $block['blockName'] );
			if ( ! isset( $blocks[ $name ] ) || ! is_array( $blocks[ $name ] ) ) {
				$blocks[ $name ] = [];
			}

			if ( 'yoast/faq-block' === $name ) {
				$block             = $this->faq_converter->convert( $block );
				$blocks[ $name ][] = $this->serialize_block( $block );
			}
		}

		return $blocks;
	}

	/**
	 * Serializes a block.
	 *
	 * @param array $block Block object.
	 *
	 * @return string String representing the block.
	 */
	private function serialize_block( $block ) {
		if ( ! isset( $block['blockName'] ) ) {
			return false;
		}

		$name = $block['blockName'];

		$opening_tag_suffix = '';
		if ( ! empty( $block['attrs'] ) ) {
			$opening_tag_suffix = ' ' . wp_json_encode( array_filter( $block['attrs'] ) );
		}

		if ( ! isset( $block['innerHTML'] ) ) {
			$block['innerHTML'] = '';
		}

		return sprintf(
			'<!-- wp:%1$s%2$s -->%3$s<!-- /wp:%1$s -->',
			$name,
			$opening_tag_suffix,
			$block['innerHTML']
		);
	}
}
