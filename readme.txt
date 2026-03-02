=== FAZ Cookie Manager ===
Contributors: fabiodalez
Tags: cookie, gdpr, ccpa, consent, privacy
Requires at least: 5.0
Tested up to: 6.7
Stable tag: 1.0.5
Requires PHP: 7.4
License: GPL-3.0-or-later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

A comprehensive GDPR/CCPA cookie consent manager with built-in cookie scanner, local consent logging, Google Consent Mode v2, and IAB TCF v2.2 support.

== Description ==

FAZ Cookie Manager is a self-hosted, cloud-free WordPress plugin that provides full cookie consent management for GDPR, CCPA, ePrivacy Directive, and Italian Garante Privacy compliance.

**Key Features:**

* Cookie consent banner with full customization (colors, layout, position, animations)
* Built-in cookie scanner — scans your site locally without external services
* Local consent logging with CSV export for GDPR accountability
* Google Consent Mode v2 (GCM) and Google Additional Consent Mode (GACM)
* IAB TCF v2.2 Consent Management Platform (CMP)
* Geo-targeting — show banners only to visitors from regulated regions
* Script blocking via `data-faz-tag` attribute
* Multi-language support with customizable translations
* Revisit consent widget for users to modify their preferences
* Microsoft UET/Clarity consent integration
* Keyboard accessible and mobile responsive
* No external API calls — all data stays on your server

**Compliance:**

* GDPR (EU General Data Protection Regulation)
* CCPA (California Consumer Privacy Act)
* ePrivacy Directive
* Italian Garante Privacy guidelines (cookie expiry <= 6 months)
* EDPB guidelines (scroll does not equal consent)

== Installation ==

1. Upload the `faz-cookie-manager` folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to **FAZ Cookie** in the admin menu to configure your banner
4. Use the built-in scanner to detect cookies on your site
5. Customize categories, banner text, and design to match your site

== Frequently Asked Questions ==

= Does this plugin require a cloud account? =

No. FAZ Cookie Manager is fully self-hosted. All data (consent logs, cookie scans, settings) stays on your server.

= Is it compatible with Google Consent Mode v2? =

Yes. The plugin sends proper consent signals (`ad_storage`, `analytics_storage`, `ad_user_data`, `ad_personalization`, `functionality_storage`, `personalization_storage`, `security_storage`) and supports Google Additional Consent Mode (GACM).

= Does the banner block cookies before consent? =

Yes. Scripts tagged with `data-faz-tag` are blocked until the user grants consent for the corresponding category.

= How do I scan for cookies? =

Go to **FAZ Cookie > Cookies** and click "Scan Cookies". The scanner runs locally in your browser and detects cookies set by your site.

= Can users change their consent after accepting? =

Yes. A revisit widget (floating button) lets users reopen the preference center at any time.

= Is it WCAG accessible? =

Yes. The banner supports full keyboard navigation (Tab, Enter, Escape) and follows accessibility best practices.

== Changelog ==

= 1.0.5 =
* Unified text domain and plugin slug
* Added WordPress.com Marketplace compliance headers
* Cleaned up directory structure

= 1.0.4 =
* Full uninstall/reinstall support
* Improved consent cookie handling

= 1.0.3 =
* Browser-based cookie scanner with iframe detection
* Local consent log storage with DB table and CSV export

= 1.0.2 =
* Unlocked all premium features for local use
* Removed all cloud dependencies

= 1.0.1 =
* Complete de-branding from CookieYes
* Namespace rename to FazCookie

= 1.0.0 =
* Initial release based on CookieYes v3.4.0 fork
* Full GDPR/CCPA/ePrivacy compliance
* Google Consent Mode v2 and IAB TCF v2.2 support

== Upgrade Notice ==

= 1.0.5 =
Plugin directory and text domain updated. Clear any caches after upgrading.
