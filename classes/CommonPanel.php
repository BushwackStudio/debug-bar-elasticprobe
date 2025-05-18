<?php
/**
 * CommonPanel class file.
 *
 * @since 3.1.0
 * @package DebugBarElasticProbe
 */

namespace DebugBarElasticProbe;

defined( 'ABSPATH' ) || exit;

/**
 * CommonPanel class.
 */
class CommonPanel {
	/**
	 * Return the panel title
	 *
	 * @return string
	 */
	public function get_title(): string {
		$queries_count = count( \ElasticProbe\Elasticsearch::factory()->get_query_log() );

		if ( $queries_count ) {
			return sprintf(
				/* translators: %d: number of queries */
				esc_html__( 'ElasticProbe (%d)', 'debug-bar-elasticprobe' ),
				$queries_count
			);
		}

		return esc_html__( 'ElasticProbe', 'debug-bar-elasticprobe' );
	}

	/**
	 * Enqueue scripts for front end and admin
	 */
	public function enqueue_scripts_styles() {
		if ( ! is_user_logged_in() ) {
			return;
		}

		wp_enqueue_script( 'debug-bar-elasticpress', EPROBE_DEBUG_URL . 'assets/js/main.js', array( 'wp-dom-ready', 'clipboard' ), EPROBE_DEBUG_VERSION, true );
		wp_enqueue_style( 'debug-bar-elasticpress', EPROBE_DEBUG_URL . 'assets/css/main.css', array(), EPROBE_DEBUG_VERSION );
	}

	/**
	 * Show the contents of the panel
	 */
	public function render() {
		$queries = \ElasticProbe\Elasticsearch::factory()->get_query_log();

		if ( function_exists( '\ElasticProbe\Utils\is_indexing' ) && \ElasticProbe\Utils\is_indexing() ) {
			?>
			<div class="ep-debug-bar-warning">
				<?php esc_html_e( 'ElasticProbe is currently indexing.', 'debug-bar-elasticprobe' ); ?>
			</div>
			<?php
		}

		$debug_bar_output = new \DebugBarElasticProbe\QueryOutput( $queries );
		$debug_bar_output->render_buttons();
		$debug_bar_output->render_additional_buttons();
		$debug_bar_output->render_queries();
	}
}
