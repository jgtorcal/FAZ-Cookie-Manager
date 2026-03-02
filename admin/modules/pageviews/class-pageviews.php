<?php
/**
 * Class Pageviews file.
 *
 * @package FazCookie
 */

namespace FazCookie\Admin\Modules\Pageviews;

use FazCookie\Includes\Modules;
use FazCookie\Admin\Modules\Pageviews\Includes\Controller;
use FazCookie\Admin\Modules\Pageviews\Api\Api;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Handles Pageview and Banner Interaction Tracking.
 *
 * @class       Pageviews
 * @version     1.0.0
 * @package     FazCookie
 */
class Pageviews extends Modules {

	/**
	 * Pageviews controller class.
	 *
	 * @var object
	 */
	private $controller;

	/**
	 * Constructor.
	 */
	public function init() {
		$this->load_apis();
		$this->controller = Controller::get_instance();
	}

	/**
	 * Load API files
	 *
	 * @return void
	 */
	public function load_apis() {
		new Api();
	}
}
