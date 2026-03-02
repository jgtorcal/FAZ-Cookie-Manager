<?php
/**
 * FAZ Cookie Manager — Languages Page
 *
 * @package FazCookie\Admin
 */

defined( 'ABSPATH' ) || exit;

// Load full language list from controller.
$lang_controller = \FazCookie\Admin\Modules\Languages\Includes\Controller::get_instance();
$all_languages   = $lang_controller->get_languages(); // [ 'English' => 'en', ... ]

// Flip so we get [ 'en' => 'English', ... ] for easier JS consumption.
$lang_map = array();
foreach ( $all_languages as $name => $code ) {
	$lang_map[ $code ] = $name;
}
?>
<div id="faz-languages">

	<div class="faz-card">
		<div class="faz-card-header">
			<h3>Active Languages</h3>
		</div>
		<div class="faz-card-body">

			<div class="faz-form-group">
				<label>Selected Languages</label>
				<div id="faz-lang-tags" class="faz-lang-tags">
					<!-- JS renders selected language tags here -->
				</div>
			</div>

			<div class="faz-form-group">
				<label>Add Language</label>
				<div class="faz-lang-search-wrap">
					<input type="text" class="faz-input" id="faz-lang-search" placeholder="Search languages..." autocomplete="off">
					<div id="faz-lang-dropdown" class="faz-lang-dropdown"></div>
				</div>
				<div class="faz-help">Type to search from <?php echo count( $lang_map ); ?> available languages.</div>
			</div>

			<div class="faz-form-group">
				<label>Default Language</label>
				<select class="faz-select" id="faz-default-lang" style="width:auto;max-width:300px;">
					<!-- JS populates from selected languages -->
				</select>
			</div>
		</div>
		<div class="faz-card-footer">
			<button class="faz-btn faz-btn-primary" id="faz-lang-save">Save Languages</button>
		</div>
	</div>
</div>

<script>
	window.fazAllLanguages = <?php echo wp_json_encode( $lang_map ); ?>;
</script>
