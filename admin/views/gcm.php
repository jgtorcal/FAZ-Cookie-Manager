<?php
/**
 * FAZ Cookie Manager — Google Consent Mode Page
 *
 * @package FazCookie\Admin
 */

defined( 'ABSPATH' ) || exit;
?>
<div id="faz-gcm">

	<div class="faz-card">
		<div class="faz-card-header">
			<h3>Google Consent Mode v2</h3>
		</div>
		<div class="faz-card-body">
			<div class="faz-form-group">
				<label class="faz-toggle">
					<input type="checkbox" data-path="status" id="faz-gcm-enabled">
					<span class="faz-toggle-track"></span>
					<span class="faz-toggle-label">Enable Google Consent Mode</span>
				</label>
			</div>
		</div>
	</div>

	<div class="faz-card">
		<div class="faz-card-header">
			<h3>Consent Signal Defaults</h3>
		</div>
		<div class="faz-card-body">
			<div class="faz-table-wrap">
				<table class="faz-table">
					<thead>
						<tr>
							<th>Consent Type</th>
							<th>Default (before consent)</th>
							<th>When Granted</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><strong>ad_storage</strong></td>
							<td><span class="faz-badge faz-badge-danger">denied</span></td>
							<td><span class="faz-badge faz-badge-success">granted</span></td>
						</tr>
						<tr>
							<td><strong>analytics_storage</strong></td>
							<td><span class="faz-badge faz-badge-danger">denied</span></td>
							<td><span class="faz-badge faz-badge-success">granted</span></td>
						</tr>
						<tr>
							<td><strong>ad_user_data</strong></td>
							<td><span class="faz-badge faz-badge-danger">denied</span></td>
							<td><span class="faz-badge faz-badge-success">granted</span></td>
						</tr>
						<tr>
							<td><strong>ad_personalization</strong></td>
							<td><span class="faz-badge faz-badge-danger">denied</span></td>
							<td><span class="faz-badge faz-badge-success">granted</span></td>
						</tr>
						<tr>
							<td><strong>functionality_storage</strong></td>
							<td><span class="faz-badge faz-badge-danger">denied</span></td>
							<td><span class="faz-badge faz-badge-success">granted</span></td>
						</tr>
						<tr>
							<td><strong>personalization_storage</strong></td>
							<td><span class="faz-badge faz-badge-danger">denied</span></td>
							<td><span class="faz-badge faz-badge-success">granted</span></td>
						</tr>
						<tr>
							<td><strong>security_storage</strong></td>
							<td><span class="faz-badge faz-badge-success">granted</span></td>
							<td><span class="faz-badge faz-badge-success">granted</span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="faz-card">
		<div class="faz-card-header">
			<h3>Advanced Settings</h3>
		</div>
		<div class="faz-card-body">
			<div class="faz-form-group">
				<label>Wait for Update (ms)</label>
				<input type="number" class="faz-input faz-input-sm" data-path="wait_for_update" value="500" min="0" style="width:120px;">
				<div class="faz-help">Milliseconds to wait for consent update before firing tags. Default: 500.</div>
			</div>
			<div class="faz-form-group">
				<label class="faz-toggle">
					<input type="checkbox" data-path="url_passthrough">
					<span class="faz-toggle-track"></span>
					<span class="faz-toggle-label">URL Passthrough</span>
				</label>
				<div class="faz-help">Pass ad click information through URLs when ad_storage is denied.</div>
			</div>
			<div class="faz-form-group">
				<label class="faz-toggle">
					<input type="checkbox" data-path="ads_data_redaction">
					<span class="faz-toggle-track"></span>
					<span class="faz-toggle-label">Ads Data Redaction</span>
				</label>
				<div class="faz-help">Redact ad click identifiers when ad_storage is denied.</div>
			</div>
		</div>
	</div>

	<div class="faz-card">
		<div class="faz-card-header">
			<h3>Google Additional Consent Mode (GACM)</h3>
		</div>
		<div class="faz-card-body">
			<div class="faz-form-group">
				<label class="faz-toggle">
					<input type="checkbox" data-path="gacm_enabled">
					<span class="faz-toggle-track"></span>
					<span class="faz-toggle-label">Enable GACM</span>
				</label>
			</div>
			<div class="faz-form-group">
				<label>Ad Technology Provider IDs</label>
				<textarea class="faz-textarea" data-path="gacm_provider_ids" rows="3" placeholder="Comma-separated provider IDs, e.g. 89,91,128"></textarea>
				<div class="faz-help">Google Ad Tech Provider IDs to include in the AC string.</div>
			</div>
		</div>
	</div>

	<div style="margin-top:8px;">
		<button class="faz-btn faz-btn-primary" id="faz-gcm-save">Save GCM Settings</button>
	</div>
</div>
