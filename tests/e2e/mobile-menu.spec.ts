import { test, expect } from '@playwright/test';

test.use({ viewport: { width: 375, height: 812 } });

test('Le menu mobile est fermé par défaut et s’ouvre au clic', async ({ page }) => {
  await page.goto('/');

  const bouton = page.getByTestId('nav-toggle');
  const lienProjets = page.locator('#mainNav').getByRole('link', { name: 'Projets', exact: true });

  // Menu fermé : les liens ne sont pas visibles
  await expect(bouton).toHaveAttribute('aria-expanded', 'false');
  await expect(lienProjets).toBeHidden();

  // Ouverture
  await bouton.click();
  await expect(bouton).toHaveAttribute('aria-expanded', 'true');
  await expect(lienProjets).toBeVisible();

  // Un clic sur un lien mène à la page
  await lienProjets.click();
  await expect(page).toHaveURL(/projet\.html$/);
});
