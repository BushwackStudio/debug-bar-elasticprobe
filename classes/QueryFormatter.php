<?php
/**
 * Queries report class
 *
 * @since 3.0.0
 * @package DebugBarWPProbe
 */

namespace DebugBarWPProbe;

use WPProbe\QueryLogger;

defined( 'ABSPATH' ) || exit;

/**
 * Queries report class
 *
 * @package DebugBarWPProbe
 */
class QueryFormatter extends QueryLogger {
	/**
	 * Format queries to display
	 *
	 * @param array $queries Queries to be displayed
	 * @return array
	 */
	public function format_queries_for_display( $queries ): array {
		$formatted_queries = [];

		$labels = [
			'wp_url'      => esc_html__( 'Page URL', 'debug-bar-wpprobe' ),
			'es_req'      => esc_html__( 'Elasticsearch Request', 'debug-bar-wpprobe' ),
			'request_id'  => esc_html__( 'Request ID', 'debug-bar-wpprobe' ),
			'timestamp'   => esc_html__( 'Time', 'debug-bar-wpprobe' ),
			'query_time'  => esc_html__( 'Time Spent (ms)', 'debug-bar-wpprobe' ),
			'wp_args'     => esc_html__( 'WP Query Args', 'debug-bar-wpprobe' ),
			'status_code' => esc_html__( 'HTTP Status Code', 'debug-bar-wpprobe' ),
			'body'        => esc_html__( 'Query Body', 'debug-bar-wpprobe' ),
			'result'      => esc_html__( 'Query Result', 'debug-bar-wpprobe' ),
		];

		$failed_queries_obj = new \WPProbe\StatusReport\FailedQueries( $this );

		foreach ( $queries as $query ) {
			$query                    = $this->format_log_entry( $query, 'query' );
			list( $error, $solution ) = $failed_queries_obj->analyze_log( $query );

			$fields = [];
			if ( ! empty( $error ) ) {
				$fields['error']                = [
					'label' => __( 'Error', 'debug-bar-wpprobe' ),
					'value' => $error,
				];
				$fields['recommended_solution'] = [
					'label' => __( 'Recommended Solution', 'debug-bar-wpprobe' ),
					'value' => $solution,
				];
			}

			foreach ( $query as $field => $value ) {
				// Already outputted in the title
				if ( in_array( $field, [ 'wp_url', 'timestamp' ], true ) ) {
					continue;
				}

				$fields[ $field ] = [
					'label' => $labels[ $field ] ?? $field,
					'value' => $value,
				];
			}

			$formatted_queries[] = [
				'title'  => sprintf( '%s (%s)', $query['wp_url'], date_i18n( 'Y-m-d H:i:s', $query['timestamp'] ) ),
				'fields' => $fields,
			];
		}

		return $formatted_queries;
	}
}
