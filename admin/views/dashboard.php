<?php
/**
 * FAZ Cookie Manager — Dashboard Page
 *
 * @package FazCookie\Admin
 */

defined( 'ABSPATH' ) || exit;
?>

<div id="faz-dashboard">
	<div class="faz-grid faz-grid-4" id="faz-stats-row">
		<div class="faz-stat-card">
			<div class="faz-stat-icon faz-stat-icon-primary">
				<span class="dashicons dashicons-visibility"></span>
			</div>
			<div class="faz-stat-value" id="faz-stat-pageviews">--</div>
			<div class="faz-stat-label">Total Pageviews</div>
		</div>
		<div class="faz-stat-card">
			<div class="faz-stat-icon faz-stat-icon-warning">
				<span class="dashicons dashicons-megaphone"></span>
			</div>
			<div class="faz-stat-value" id="faz-stat-banner">--</div>
			<div class="faz-stat-label">Banner Views</div>
		</div>
		<div class="faz-stat-card">
			<div class="faz-stat-icon faz-stat-icon-success">
				<span class="dashicons dashicons-yes-alt"></span>
			</div>
			<div class="faz-stat-value" id="faz-stat-accept">--</div>
			<div class="faz-stat-label">Accept Rate</div>
		</div>
		<div class="faz-stat-card">
			<div class="faz-stat-icon faz-stat-icon-danger">
				<span class="dashicons dashicons-dismiss"></span>
			</div>
			<div class="faz-stat-value" id="faz-stat-reject">--</div>
			<div class="faz-stat-label">Reject Rate</div>
		</div>
	</div>

	<div class="faz-chart-filter-bar" style="margin-top:20px;">
		<div class="faz-chart-filter-presets">
			<button type="button" class="faz-chart-filter-btn" data-days="1">1D</button>
			<button type="button" class="faz-chart-filter-btn active" data-days="7">7D</button>
			<button type="button" class="faz-chart-filter-btn" data-days="30">30D</button>
			<button type="button" class="faz-chart-filter-btn" data-days="365">1Y</button>
			<button type="button" class="faz-chart-filter-btn" data-days="0">All</button>
		</div>
		<div class="faz-chart-filter-custom">
			<input type="date" id="faz-filter-from" class="faz-input">
			<span style="color:var(--faz-text-muted)">&mdash;</span>
			<input type="date" id="faz-filter-to" class="faz-input">
			<button type="button" class="faz-btn faz-btn-sm faz-btn-secondary" id="faz-filter-apply">Apply</button>
		</div>
	</div>

	<div class="faz-grid faz-grid-2" style="margin-top:12px;">
		<div class="faz-card">
			<div class="faz-card-header">
				<h3>Pageviews &mdash; <span id="faz-chart-range-label">Last 7 Days</span></h3>
			</div>
			<div class="faz-card-body">
				<div class="faz-chart-wrap">
					<canvas id="faz-chart-pageviews" width="600" height="220" style="width:100%;height:220px;"></canvas>
					<div id="faz-chart-empty" class="faz-chart-empty faz-hidden">
						<span class="dashicons dashicons-chart-area"></span>
						<p>No pageview data yet.<br>Data will appear once visitors interact with your site.</p>
					</div>
				</div>
			</div>
		</div>

		<div class="faz-card">
			<div class="faz-card-header">
				<h3>Consent Distribution &mdash; <span id="faz-consent-range-label">Last 7 Days</span></h3>
			</div>
			<div class="faz-card-body">
				<div class="faz-chart-wrap">
					<canvas id="faz-chart-consent" width="300" height="220" style="width:100%;height:220px;"></canvas>
					<div id="faz-consent-empty" class="faz-chart-empty faz-hidden">
						<span class="dashicons dashicons-chart-pie"></span>
						<p>No consent data yet.<br>Data will appear once visitors respond to the banner.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="faz-card">
		<div class="faz-card-header">
			<h3>Quick Links</h3>
		</div>
		<div class="faz-card-body">
			<div class="faz-grid faz-grid-3">
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=faz-cookie-manager-cookies' ) ); ?>" class="faz-quick-link">
					<span class="dashicons dashicons-admin-generic"></span>
					<span class="faz-quick-link-text">Manage Cookies</span>
				</a>
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=faz-cookie-manager-banner' ) ); ?>" class="faz-quick-link">
					<span class="dashicons dashicons-megaphone"></span>
					<span class="faz-quick-link-text">Cookie Banner</span>
				</a>
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=faz-cookie-manager-gcm' ) ); ?>" class="faz-quick-link">
					<span class="dashicons dashicons-chart-bar"></span>
					<span class="faz-quick-link-text">Google Consent Mode</span>
				</a>
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=faz-cookie-manager-consent-logs' ) ); ?>" class="faz-quick-link">
					<span class="dashicons dashicons-list-view"></span>
					<span class="faz-quick-link-text">Consent Logs</span>
				</a>
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=faz-cookie-manager-languages' ) ); ?>" class="faz-quick-link">
					<span class="dashicons dashicons-translation"></span>
					<span class="faz-quick-link-text">Languages</span>
				</a>
				<a href="<?php echo esc_url( admin_url( 'admin.php?page=faz-cookie-manager-settings' ) ); ?>" class="faz-quick-link">
					<span class="dashicons dashicons-admin-settings"></span>
					<span class="faz-quick-link-text">Settings</span>
				</a>
			</div>
		</div>
	</div>
</div>
