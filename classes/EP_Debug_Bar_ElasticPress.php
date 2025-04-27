<?php
/**
 * New Debug Bar Panel class file.
 *
 * This class can not be in a namespace or Debug Bar won't be able to generate a correct HTML ID for its panel.
 * Also, Query Monitor has a special CSS rule just for this plugin with this class name.
 *
 * phpcs:disable WordPress.PHP.DevelopmentFunctions
 *
 * @package DebugBarWPProbe
 */

defined( 'ABSPATH' ) || exit;

/**
 * New Debug Bar Panel class.
 */
class EP_Debug_Bar_WPProbe extends \Debug_Bar_Panel {

	/**
	 * Panel menu title
	 *
	 * @var string|null
	 */
	public $title;

	/**
	 * Common panel instance
	 *
	 * @var \DebugBarWPProbe\CommonPanel
	 */
	protected $common_panel;

	/**
	 * Initial debug bar stuff
	 */
	public function init() {
		$this->title( esc_html__( 'WPProbe', 'debug-bar-wpprobe' ) );

		$this->common_panel = new \DebugBarWPProbe\CommonPanel();
		$this->common_panel->enqueue_scripts_styles();
	}

	/**
	 * Enqueue scripts for front end and admin
	 */
	public function enqueue_scripts_styles() {
		_deprecated_function( __METHOD__, '3.1.0', 'DebugBarWPProbe\EP_Panel::enqueue_scripts_styles()' );
	}

	/**
	 * Show the menu item in Debug Bar.
	 */
	public function prerender() {
		$this->set_visible( true );
	}

	/**
	 * Show the contents of the panel
	 */
	public function render() {
		$queries          = \WPProbe\Elasticsearch::factory()->get_query_log();
		$total_query_time = 0;

		foreach ( $queries as $query ) {
			if ( ! empty( $query['time_start'] ) && ! empty( $query['time_finish'] ) ) {
				$total_query_time += ( $query['time_finish'] - $query['time_start'] );
			}
		}

		?>

		<h2>
			<?php
			echo wp_kses_post(
				/* translators: queries count. */
				sprintf( __( '<span>Total WPProbe Queries:</span> %d', 'debug-bar-wpprobe' ), count( $queries ) )
			);
			?>
		</h2>
		<h2>
			<?php
			echo wp_kses_post(
				/* translators: blocking query time. */
				sprintf( __( '<span>Total Blocking WPProbe Query Time:</span> %d ms', 'debug-bar-wpprobe' ), (int) ( $total_query_time * 1000 ) )
			);
			?>
		</h2>

		<?php
		$this->common_panel->render();
	}
}
