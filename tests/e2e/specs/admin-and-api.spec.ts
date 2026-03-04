import { expect, test } from '../fixtures/wp-fixture';

const ADMIN_PAGES = [
  'faz-cookie-manager',
  'faz-cookie-manager-banner',
  'faz-cookie-manager-cookies',
  'faz-cookie-manager-settings',
  'faz-cookie-manager-gcm',
  'faz-cookie-manager-languages',
  'faz-cookie-manager-consent-logs',
  'faz-cookie-manager-gvl',
];

test.describe('Admin and REST integration', () => {
  test('admin pages are reachable only after successful auth', async ({ page, wpBaseURL, loginAsAdmin }) => {
    await loginAsAdmin(page);

    for (const slug of ADMIN_PAGES) {
      await page.goto(`${wpBaseURL}/wp-admin/admin.php?page=${slug}`, { waitUntil: 'domcontentloaded' });
      await expect(page.locator('#wpadminbar')).toBeVisible();
      await expect(page.locator('#loginform')).toHaveCount(0);
      await expect(page).toHaveURL(new RegExp(`page=${slug}`));
    }
  });

  test('settings API returns data with valid nonce and rejects invalid nonce', async ({ page, loginAsAdmin }) => {
    await loginAsAdmin(page);
    await page.goto('/wp-admin/admin.php?page=faz-cookie-manager-settings', { waitUntil: 'domcontentloaded' });

    const settingsResponse = await page.evaluate(async () => {
      const nonce = window.fazConfig?.api?.nonce ?? '';
      const response = await fetch('/?rest_route=/faz/v1/settings/', {
        headers: { 'X-WP-Nonce': nonce },
      });
      const payload = await response.json().catch(() => null);
      return {
        noncePresent: nonce.length > 0,
        status: response.status,
        payload,
      };
    });

    expect(settingsResponse.noncePresent).toBeTruthy();
    expect(settingsResponse.status).toBe(200);
    expect(settingsResponse.payload).toBeTruthy();
    expect(settingsResponse.payload).toHaveProperty('geolocation');

    const badNonceStatus = await page.evaluate(async () => {
      const response = await fetch('/?rest_route=/faz/v1/settings/', {
        headers: { 'X-WP-Nonce': 'invalid-nonce' },
      });
      return response.status;
    });

    expect([401, 403]).toContain(badNonceStatus);
  });

  test('cookies API returns an array payload', async ({ page, loginAsAdmin }) => {
    await loginAsAdmin(page);
    await page.goto('/wp-admin/admin.php?page=faz-cookie-manager-cookies', { waitUntil: 'domcontentloaded' });

    const cookiesResponse = await page.evaluate(async () => {
      const nonce = window.fazConfig?.api?.nonce ?? '';
      const response = await fetch('/?rest_route=/faz/v1/cookies/', {
        headers: { 'X-WP-Nonce': nonce },
      });
      const payload = await response.json().catch(() => null);
      return {
        status: response.status,
        payload,
      };
    });

    expect(cookiesResponse.status).toBe(200);
    expect(Array.isArray(cookiesResponse.payload)).toBeTruthy();
  });
});
