<?php
/**
 * QueryMonitorCollector class file.
 *
 * @since 3.1.0
 * @package DebugBarElasticProbe
 */

namespace DebugBarElasticProbe;

defined( 'ABSPATH' ) || exit;

/**
 * QueryMonitorCollector class.
 */
class QueryMonitorCollector extends \QM_Collector {
	/**
	 * Collector ID
	 *
	 * @var string
	 */
	public $id = 'elasticprobe';
}
