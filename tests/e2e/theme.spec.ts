import { test, expect } from '@playwright/test';

test('Le thème choisi est conservé après rechargement', async ({ page }) => {
  await page.emulateMedia({ colorScheme: 'dark' });
  await page.goto('/');

  const html = page.locator('html');
  await expect(html).toHaveAttribute('data-theme', 'dark');

  // L'utilisateur change de thème
  await page.getByTestId('theme-toggle').click();
  await expect(html).toHaveAttribute('data-theme', 'light');

  // Après rechargement, le choix est toujours là
  await page.reload();
  await expect(html).toHaveAttribute('data-theme', 'light');
});
