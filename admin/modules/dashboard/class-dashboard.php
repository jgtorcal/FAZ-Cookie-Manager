<?php
/**
 * Class Dashboard file.
 *
 * @package FazCookie
 */

namespace FazCookie\Admin\Modules\Dashboard;

use FazCookie\Includes\Modules;
use FazCookie\Admin\Modules\Dashboard\Api\Api;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Handles Cookies Operation
 *
 * @class       Dashboard
 * @version     3.0.0
 * @package     FazCookie
 */
class Dashboard extends Modules {

	/**
	 * Constructor.
	 */
	public function init() {
		$this->load_apis();

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
