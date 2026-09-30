import { test, expect } from '@playwright/test';

const pages = [
  { lien: 'Projets', url: /projet\.html$/, titre: 'Chaudet Lucas - Projets' },
  { lien: 'Compétences', url: /competence\.html$/, titre: 'Chaudet Lucas - Compétences' },
  { lien: 'Contact', url: /contact\.html$/, titre: 'Chaudet Lucas - Contact' },
];

for (const p of pages) {
  test(`Le menu mène à la page ${p.lien}`, async ({ page }) => {
    await page.goto('/');

    const menu = page.getByRole('navigation');
    await menu.getByRole('link', { name: p.lien, exact: true }).click();

    await expect(page).toHaveURL(p.url);
    await expect(page).toHaveTitle(p.titre);
    await expect(menu.getByRole('link', { name: p.lien, exact: true }))
      .toHaveAttribute('aria-current', 'page');
  });
}
