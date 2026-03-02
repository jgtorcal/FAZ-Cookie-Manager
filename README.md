# FAZ Cookie Manager

A comprehensive, self-hosted WordPress cookie consent manager. GDPR, ePrivacy, CCPA, Garante Privacy (Italy), IAB TCF v2.2, and Google Consent Mode v2 compliant — with no cloud dependencies.

Based on CookieYes v3.4.0, fully de-branded and re-engineered to run entirely locally. Every premium feature is unlocked. No account, no external API, no subscription required.

---

## Compliance Standards

| Standard | Status | Details |
|----------|--------|---------|
| GDPR (EU) | Compliant | Opt-in model, granular consent, right to withdraw |
| ePrivacy Directive | Compliant | No cookies before consent, technical cookie exemption |
| Garante Privacy LG 2021 (Italy) | Compliant | Equal-weight buttons, no scroll-as-consent, 6-month max expiry |
| CCPA (California) | Supported | "Do Not Sell" opt-out, GPC signal detection |
| IAB TCF v2.2 | Supported | Full `__tcfapi()` CMP, TC string generation, cross-frame messaging |
| Google Consent Mode v2 | Compliant | Default-denied signals, consent update on interaction |
| WCAG 2.1 AA | Partial | Keyboard navigation, focus indicators, ARIA labels |
| WP Consent API | Compliant | Registered via `wp_consent_api_registered_` filter |

### Automated Compliance Tests

21 Playwright tests verify compliance at runtime (see `compliance-tests.mjs`):

- TF01–TF18: Full functional test suite covering banner display, cookie blocking, consent flow, mobile, accessibility, revocation, logging, GCM signals, and cookie declarations
- P05: No ambiguous button labels (dark pattern check)
- G07: Non-technical toggles OFF by default
- I08: Technical cookies non-disableable

**All 21 tests pass.**

---

## Features

### Cookie Banner

- **Three banner types**: Classic (bar), Popup (modal), Box (widget)
- **Configurable position**: Top, bottom, or any corner
- **Three legislation modes**: GDPR (opt-in), CCPA (opt-out), Info-only
- **Preference center**: Granular per-category toggles with cookie audit tables
- **Full color customization**: Background, text, button colors via color pickers
- **Theme presets**: Light and dark themes as starting points
- **Brand logo**: Upload custom logo via WordPress Media Library
- **Live preview**: Real-time banner preview in admin as you edit settings
- **Responsive**: Adapts to mobile viewports, tested on 375px width
- **RTL support**: Arabic, Hebrew, Persian, Urdu, and other RTL languages
- **Consent expiry**: Capped at 180 days (6 months) per Garante Privacy requirements
- **Revisit widget**: Floating button to reopen preferences after consent
- **Video placeholder**: Blocks YouTube/Vimeo embeds until consent, shows placeholder
- **Page exclusions**: Skip banner on specific pages (supports wildcards)
- **Subdomain sharing**: Share consent across subdomains via root-domain cookie
- **Reload on accept**: Optional page reload after consent given
- **Close on scroll**: Disabled by default (scroll ≠ consent per EDPB guidelines)

### Buttons

- **Accept All** — grants consent to all categories
- **Reject All** — denies all non-necessary categories (equal visual weight as Accept)
- **Customize / Settings** — opens preference center for granular control
- **Read More** — links to privacy policy (configurable: button or link, nofollow, new tab)
- **Do Not Sell** — CCPA opt-out button (only in CCPA mode)

### Cookie Management

- **Cookie list**: Full CRUD for cookies — name, domain, duration, description, category, URL pattern
- **Cookie categories**: Necessary, Functional, Analytics, Performance, Advertisement, Uncategorized
- **Audit table**: Per-category cookie listing embedded in the preference center
- **Multilingual descriptions**: Cookie description and duration stored per-language

### Cookie Scanner

A fully local PHP-based cookie crawler — no external scanning service.

- Discovers pages via sitemap.xml parsing + homepage link extraction
- Fetches each page and extracts `Set-Cookie` response headers
- Detects: cookie name, value, domain, path, expires, max-age, secure, httponly, samesite
- Converts expiry to human-readable duration
- Deduplicates — never overwrites existing cookie entries
- Configurable max pages (default: 20)
- Scan history with last 50 results
- Supports static IP override for staging environments behind load balancers
- Runs asynchronously via WP-CLI, PHP subprocess, or WP-Cron

### Open Cookie Database

Integrates the [Open Cookie Database](https://github.com/fabiodalez-dev/Open-Cookie-Database) (Apache-2.0) for automatic cookie identification.

- **2,200+ cookie definitions** from major platforms (Google, Facebook, Microsoft, Stripe, etc.)
- **Auto-download** on first activation
- **Manual update** via admin UI button
- **Exact + wildcard matching**: e.g., `_gat_` prefix matches `_gat_UA-12345`
- **Category mapping**: functional, analytics, marketing → FAZ category slugs
- **Auto-categorize**: One-click bulk categorization of uncategorized or all cookies

### Google Consent Mode v2

Full GCM v2 integration with all required consent signals:

- `ad_storage`, `analytics_storage`, `functionality_storage`, `personalization_storage`, `security_storage`
- `ad_user_data`, `ad_personalization` (v2 additions)
- **Default: all denied** — updates to granted on consent
- **Region-specific defaults** — configure per-region consent states
- **Wait for update** — configurable delay (ms) for slow-loading CMPs
- **URL passthrough** — pass ad click info even when consent denied
- **Ads data redaction** — redact ad data when consent denied
- **Developer ID**: `dY2Q2ZW` for GTM identification
- Reads `fazcookie-consent` cookie and calls `gtag('consent', 'update', ...)` dynamically

### Google Additional Consent Mode (GACM)

- Enable/disable toggle
- Configure ATP (Authorized Technology Provider) IDs
- Generates Additional Consent string format: `1~id.id.id...`
- Sets via `gtag('set', 'addtl_consent', ...)`

### IAB TCF v2.2 CMP

Full `__tcfapi()` implementation compliant with the IAB Transparency & Consent Framework v2.2:

- **Commands**: `ping`, `getTCData`, `addEventListener`, `removeEventListener`
- **TC String generation**: Minimal base64url core-segment with purpose consent bits
- **Category → Purpose mapping**:
  - Necessary → Purpose 1 (store/access device info)
  - Functional → Purposes 5, 6 (personalized content)
  - Analytics → Purposes 7, 8, 9, 10 (measurement)
  - Advertisement → Purposes 2, 3, 4, 7 (ads)
- **Cross-frame messaging**: `__tcfapiLocator` iframe + `postMessage` bridge
- **Command queue**: Processes pre-load `__tcfapi.a` queue
- **Events**: `tcloaded`, `useractioncomplete`, `cmpuishown`
- TCF Policy Version: 4, CMP Status tracking

### Microsoft Consent Integration

- **UET Consent Mode**: Sets `ad_storage`/`analytics_storage` defaults to denied, updates on consent
- **Clarity Consent API**: Calls `window.clarity('consent')` when analytics accepted

### Consent Logging

Stores proof of consent in a local database table for GDPR accountability:

- **Consent ID**: Unique per-visitor identifier
- **Status**: accepted, rejected, or partial
- **Categories**: JSON map of which categories were accepted/rejected
- **IP hash**: SHA256 hash (privacy-preserving, no raw IPs stored)
- **User agent** and **page URL** of consent action
- **Pagination** and **search** in admin UI
- **CSV export** with date-stamped filename
- **Retention period**: Configurable (default: 12 months)

### Pageview Analytics

Built-in analytics dashboard — no Google Analytics needed for basic metrics:

- **Events tracked**: pageview, banner_view, banner_accept, banner_reject, banner_settings
- **Session-based**: Uses `sessionStorage` (`faz_sid`)
- **Dashboard charts**: Daily pageview trend, accept/reject rates
- **Banner stats**: Total views, accepts, rejects over configurable periods

### Geolocation

Detects visitor country for geo-targeted banner display:

- **Detection chain**: Cloudflare → Apache mod_geoip → PHP GeoIP extension → ip-api.com
- **Geo-targeting modes**: ALL (everyone), EU (EU/EEA + UK, 31 countries), US only, Custom country list
- **Proxy-aware**: Reads `CF-Connecting-IP`, `X-Forwarded-For`, `X-Real-IP` headers
- **Cached**: 1-hour WordPress transient per IP

### Multilingual Support

- **10 bundled languages**: English, German, French, Italian, Spanish, Polish, Portuguese (PT + BR), Hungarian, Finnish
- **30+ additional** banner translation files available
- **130+ selectable languages** in the admin configuration
- **Browser language detection**: Parses `Accept-Language` header with quality factor sorting
- **Plugin integration**: Polylang and WPML auto-detected and used when active
- **Per-language banner content**: Separate title, description, button text per language
- **Per-language cookie descriptions**: Stored as `{ "en": "...", "de": "...", "it": "..." }` JSON objects
- **RTL auto-detection**: Arabic, Hebrew, Persian, Kurdish, Urdu, Azerbaijani, Divehi

### Shortcodes

| Shortcode | Description |
|-----------|-------------|
| `[faz_cookie_table]` | Responsive cookie table grouped by category for policy pages |
| `[cookie_audit]` | Backward-compatible alias |

**Attributes:**
- `columns` — comma-separated: `name`, `domain`, `duration`, `description`, `category` (default: `name,domain,duration,description`)
- `category` — filter by category slug or ID
- `heading` — optional heading text

The table is responsive (stacks on mobile), multilingual, and self-styled with inline CSS.

---

## REST API

All endpoints under `faz/v1`. Admin endpoints require authentication (WordPress nonce).

### Settings

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/settings` | Get all plugin settings |
| POST | `/settings` | Update settings (merge) |
| POST | `/settings/cache/purge` | Clear all caches |
| POST | `/settings/reinstall` | Recreate missing DB tables |

### Google Consent Mode

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/gcm` | Get GCM settings |
| POST | `/gcm` | Update GCM settings |

### Cookies

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/cookies` | List cookies (filter by category) |
| POST | `/cookies` | Create a cookie |
| GET/PUT/DELETE | `/cookies/{id}` | Read/update/delete a cookie |
| POST | `/cookies/bulk-update` | Bulk update cookies |
| POST | `/cookies/scrape` | Lookup names against Open Cookie Database |
| POST | `/cookies/definitions/update` | Download/refresh definitions from GitHub |
| GET | `/cookies/definitions` | Get definitions metadata |

### Scanner

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/scans` | Scan history |
| POST | `/scans` | Start a new scan |
| GET | `/scans/{id}` | Scan details |
| GET | `/scans/info` | Current scan status |

### Consent Logs

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/consent_logs` | List logs (paginated, searchable) |
| POST | `/consent_logs` | Record consent event (public, no auth) |
| GET | `/consent_logs/statistics` | Aggregate statistics |
| GET | `/consent_logs/export` | CSV export |

### Pageviews

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/pageviews` | Record event (public) |
| GET | `/pageviews/chart` | Pageview chart data |
| GET | `/pageviews/banner-stats` | Banner interaction stats |
| GET | `/pageviews/daily` | Daily trend data |

### Banners

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/banners` | List banners |
| POST | `/banners` | Create a banner |
| GET/PUT/DELETE | `/banners/{id}` | Read/update/delete a banner |
| POST | `/banners/preview` | Generate banner preview HTML |

### Languages

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/languages` | Get language configuration |
| POST | `/languages` | Update languages and translations |

---

## Database

Five custom tables (created on activation):

| Table | Purpose |
|-------|---------|
| `wp_faz_banners` | Banner configuration and per-language content |
| `wp_faz_cookies` | Cookie definitions (name, category, description, domain, pattern) |
| `wp_faz_cookie_categories` | Cookie categories (necessary, functional, analytics, etc.) |
| `wp_faz_consent_logs` | Visitor consent records with IP hash |
| `wp_faz_pageviews` | Pageview and banner interaction events |

---

## Frontend Events

JavaScript events fired on the `document` for third-party integration:

| Event | When | Detail |
|-------|------|--------|
| `fazcookie_consent_update` | User accepts/rejects/saves | `{ accepted: ['slug', ...], rejected: ['slug', ...] }` |
| `fazcookie_banner_loaded` | Banner is displayed | — |

### Consent Cookie Format

Cookie name: `fazcookie-consent`

Value format: `consentid:{base64},consent:yes,action:yes,necessary:yes,functional:no,analytics:no,advertisement:no,performance:no`

---

## WordPress Hooks

### Filters

| Filter | Description |
|--------|-------------|
| `faz_cookie_domain` | Override the consent cookie domain |
| `faz_allowed_html` | Customize allowed HTML tags in banner |
| `faz_current_language` | Override detected language |
| `faz_language_map` | Add language code normalization mappings |
| `faz_registered_admin_menus` | Register additional admin menu items |

### Actions

| Action | Description |
|--------|-------------|
| `faz_after_activate` | After plugin activation/upgrade |
| `faz_after_update_settings` | After settings are saved |
| `faz_after_update_cookie` | After cookies are bulk-updated |
| `faz_reinstall_tables` | Trigger table recreation |
| `faz_clear_cache` | Trigger cache flush |

---

## Installation

1. Download the latest release from [GitHub](https://github.com/fabiodalez-dev/faz-cookie-manager/releases)
2. Upload the `cookie-law-info/` folder to `wp-content/plugins/`
3. Activate in WordPress admin → Plugins
4. Configure at Settings → FAZ Cookie Manager

## Requirements

- WordPress 5.0+
- PHP 7.4+
- MySQL/MariaDB
- No external services required

## Changelog

### 1.0.5 — 2025-03-01
- Cleanup: removed legacy code, old Vue SPA, cloud integration dead code
- Security: ABSPATH guards on all PHP files, SQL injection hardening, IP validation
- WordPress compliance: proper plugin headers, GPL-3.0 LICENSE, index.php security files
- Fixed all remaining `cky→faz` references across JS, JSON, PHP, and CSS

### 1.0.0 — 2025-02-15
- Initial release: complete de-branding from CookieYes to FAZ Cookie Manager
- All premium features unlocked (IAB TCF, GCM, GACM, geo-targeting, cookie scraper)
- New server-rendered admin UI replacing Vue SPA
- Local consent logging with CSV export
- Local PHP cookie crawler replacing cloud scanner
- 33 automated compliance tests (21 + 12) all passing

## Author

**Fabio D'Alessandro** — [fabiodalez.it](https://fabiodalez.it/)

## License

GPL-3.0-or-later. See [LICENSE](LICENSE) for full text.

Cookie definitions powered by [Open Cookie Database](https://github.com/jkwakman/Open-Cookie-Database) (Apache-2.0).
