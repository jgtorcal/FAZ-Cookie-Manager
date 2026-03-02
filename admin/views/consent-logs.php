<?php
/**
 * FAZ Cookie Manager — Consent Logs Page
 *
 * @package FazCookie\Admin
 */

defined( 'ABSPATH' ) || exit;
?>

<div id="faz-consent-logs">

	<!-- Statistics Row -->
	<div class="faz-grid faz-grid-4" id="faz-log-stats">
		<div class="faz-stat-card">
			<div class="faz-stat-icon faz-stat-icon-primary">
				<span class="dashicons dashicons-list-view"></span>
			</div>
			<div class="faz-stat-value" id="faz-stat-total">--</div>
			<div class="faz-stat-label">Total Logs</div>
		</div>
		<div class="faz-stat-card">
			<div class="faz-stat-icon faz-stat-icon-success">
				<span class="dashicons dashicons-yes-alt"></span>
			</div>
			<div class="faz-stat-value" id="faz-stat-accepted">--</div>
			<div class="faz-stat-label">Accepted</div>
		</div>
		<div class="faz-stat-card">
			<div class="faz-stat-icon faz-stat-icon-danger">
				<span class="dashicons dashicons-dismiss"></span>
			</div>
			<div class="faz-stat-value" id="faz-stat-rejected">--</div>
			<div class="faz-stat-label">Rejected</div>
		</div>
		<div class="faz-stat-card">
			<div class="faz-stat-icon faz-stat-icon-warning">
				<span class="dashicons dashicons-marker"></span>
			</div>
			<div class="faz-stat-value" id="faz-stat-partial">--</div>
			<div class="faz-stat-label">Partial</div>
		</div>
	</div>

	<!-- Filters & Export -->
	<div class="faz-card" style="margin-top:20px;">
		<div class="faz-card-body" style="padding:12px 16px;">
			<div class="faz-filter-bar">
				<div class="faz-filter-group">
					<select class="faz-select" id="faz-log-status" style="width:auto;min-width:140px;">
						<option value="">All Statuses</option>
						<option value="accepted">Accepted</option>
						<option value="rejected">Rejected</option>
						<option value="partial">Partial</option>
					</select>
					<input type="text" class="faz-input" id="faz-log-search" placeholder="Search consent ID or URL..." style="width:260px;">
					<button class="faz-btn faz-btn-secondary" id="faz-log-filter">
						<span class="dashicons dashicons-search" style="margin-top:3px;"></span> Filter
					</button>
				</div>
				<div class="faz-filter-group">
					<button class="faz-btn faz-btn-secondary" id="faz-log-export">
						<span class="dashicons dashicons-download" style="margin-top:3px;"></span> Export CSV
					</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Logs Table -->
	<div class="faz-card" style="margin-top:16px;">
		<div class="faz-card-body" style="padding:0;">
			<table class="faz-table" id="faz-logs-table">
				<thead>
					<tr>
						<th style="width:155px;">Date</th>
						<th>Consent ID</th>
						<th style="width:95px;">Status</th>
						<th>Categories</th>
						<th style="width:110px;">IP Hash</th>
						<th>Page URL</th>
					</tr>
				</thead>
				<tbody id="faz-logs-body">
					<tr><td colspan="6" class="faz-text-center faz-text-muted" style="padding:40px;">Loading...</td></tr>
				</tbody>
			</table>
		</div>
		<div class="faz-card-footer" id="faz-log-footer" style="display:none;">
			<div class="faz-pagination-info" id="faz-log-info"></div>
			<div class="faz-pagination" id="faz-log-pagination"></div>
		</div>
	</div>
</div>
