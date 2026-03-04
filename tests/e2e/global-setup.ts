import { request } from '@playwright/test';

async function globalSetup(): Promise<void> {
  const baseURL = process.env.WP_BASE_URL ?? 'http://localhost:9998';
  const adminUser = process.env.WP_ADMIN_USER ?? 'admin';
  const adminPass = process.env.WP_ADMIN_PASS ?? 'admin';

  if (!adminUser || !adminPass) {
    throw new Error('WP_ADMIN_USER and WP_ADMIN_PASS must be set for E2E tests.');
  }

  const api = await request.newContext({
    baseURL,
    ignoreHTTPSErrors: true,
  });

  const loginPage = await api.get('/wp-login.php');
  if (!loginPage.ok()) {
    await api.dispose();
    throw new Error(`WordPress login page not reachable at ${baseURL}/wp-login.php (status ${loginPage.status()}).`);
  }

  await api.dispose();
}

export default globalSetup;
