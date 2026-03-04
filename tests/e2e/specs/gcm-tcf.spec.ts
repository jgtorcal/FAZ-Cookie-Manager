import { expect, test } from '../fixtures/wp-fixture';

test.describe('GCM and IAB TCF behavior', () => {
  test('GCM default consent is denied when feature is enabled', async ({ page }) => {
    await page.goto('/', { waitUntil: 'domcontentloaded' });

    const gcm = await page.evaluate(() => {
      // Check multiple indicators: gtag function, standard dataLayer, or custom data layer names.
      const hasGtag = typeof window.gtag === 'function';
      const hasDataLayer = Array.isArray(window.dataLayer);
      // Some setups use window.google_tag_data for GCM state.
      const hasGoogleTagData =
        typeof window.google_tag_data === 'object' &&
        window.google_tag_data !== null &&
        typeof window.google_tag_data.ics === 'object';

      const active = hasGtag || hasDataLayer || hasGoogleTagData;
      if (!active) {
        return { active: false };
      }

      const entries = [...(window.dataLayer || [])];
      const found = entries.find((entry) => {
        if (!entry) {
          return false;
        }
        return entry[0] === 'consent' && entry[1] === 'default';
      });

      return {
        active: true,
        defaults: found ? found[2] : null,
      };
    });

    test.skip(!gcm.active, 'GCM not enabled in current plugin settings');

    expect(gcm.defaults).toBeTruthy();
    expect(gcm.defaults.ad_storage).toBe('denied');
    expect(gcm.defaults.analytics_storage).toBe('denied');
  });

  test('TCF API responds when enabled', async ({ page }) => {
    await page.goto('/', { waitUntil: 'domcontentloaded' });

    const tcf = await page.evaluate(async () => {
      if (typeof window.__tcfapi !== 'function') {
        return { available: false };
      }

      const ping = await new Promise((resolve) => {
        window.__tcfapi('ping', 2, (data) => resolve(data));
      });

      return {
        available: true,
        ping,
      };
    });

    test.skip(!tcf.available, 'IAB TCF not enabled in current plugin settings');

    expect(tcf.ping).toBeTruthy();
    expect(tcf.ping.cmpLoaded).toBeTruthy();
    expect(typeof tcf.ping.gdprApplies).toBe('boolean');
    expect(tcf.ping.apiVersion).toBe('2.2');
  });
});
