/**
 * FAZ Cookie Manager — Settings Page JS
 */
(function () {
	'use strict';

	var form;

	FAZ.ready(function () {
		form = document.getElementById('faz-settings');
		if (!form) return;
		loadSettings();
		document.getElementById('faz-settings-save').addEventListener('click', saveSettings);
	});

	function loadSettings() {
		FAZ.get('settings').then(function (data) {
			// Excluded pages comes as array, convert to newline-separated text
			if (data.banner_control && Array.isArray(data.banner_control.excluded_pages)) {
				data.banner_control.excluded_pages = data.banner_control.excluded_pages.join('\n');
			}
			FAZ.populateForm(form, data);
		}).catch(function () {
			FAZ.notify('Failed to load settings', 'error');
		});
	}

	function saveSettings() {
		var btn = document.getElementById('faz-settings-save');
		FAZ.btnLoading(btn, true);

		// Load full settings first, then merge form changes on top
		FAZ.get('settings').then(function (current) {
			var formData = FAZ.serializeForm(form);

			// Convert excluded pages back to array
			if (formData.banner_control && typeof formData.banner_control.excluded_pages === 'string') {
				formData.banner_control.excluded_pages = formData.banner_control.excluded_pages
					.split('\n')
					.map(function (s) { return s.trim(); })
					.filter(Boolean);
			}

			// Deep merge form data into current settings
			Object.keys(formData).forEach(function (key) {
				if (typeof formData[key] === 'object' && formData[key] !== null && !Array.isArray(formData[key])) {
					current[key] = Object.assign({}, current[key] || {}, formData[key]);
				} else {
					current[key] = formData[key];
				}
			});

			return FAZ.post('settings', current);
		}).then(function () {
			FAZ.btnLoading(btn, false);
			FAZ.notify('Settings saved successfully');
		}).catch(function () {
			FAZ.btnLoading(btn, false);
			FAZ.notify('Failed to save settings', 'error');
		});
	}

})();
