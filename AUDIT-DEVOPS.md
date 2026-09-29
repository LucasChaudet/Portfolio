# TP #1 — Audit DevOps du projet Portfolio

Audit réalisé le 29/09/2026 sur le dépôt <https://github.com/LucasChaudet/Portfolio>.

Légende : ✅ OK · ⚠️ partiel · ❌ absent

## Grille d'audit

### Git

| Critère | Note | Constat |
|---|:-:|---|
| Dépôt GitHub existant et accessible | ✅ | Dépôt public `LucasChaudet/Portfolio`, branche par défaut `main`. |
| `.gitignore` adapté à la stack | ⚠️ → ✅ | Le `.gitignore` n'était pas versionné et n'ignorait que `data/messages.log`. Complété (`.env`, `vendor/`, logs, fichiers IDE/OS) et commité pendant ce TP. |
| Historique de commits lisible | ⚠️ | 5 commits seulement, dont deux « first commit » ; pas de convention. Des commits au format *Conventional Commits* (`feat:`, `chore:`, `docs:`) ont été ajoutés pendant ce TP. |
| Branche `main` protégée | ❌ | L'API GitHub indique `"protected": false` : les push directs sur `main` sont possibles. |

### Build & Run

| Critère | Note | Constat |
|---|:-:|---|
| Démarrage en une commande documentée | ⚠️ → ✅ | Le README ne contenait que le titre. Il documente maintenant `php -S localhost:8000`. |
| Dépendances listées | ⚠️ | Aucune dépendance externe (PHP pur), mais pas de `composer.json` pour déclarer la version de PHP requise. Documentée dans le README (PHP 8.1+, `mbstring`). |
| Pas de chemin absolu codé en dur | ✅ | Aucun chemin absolu ; les chemins sont relatifs ou basés sur `__DIR__`. |

### Tests

| Critère | Note | Constat |
|---|:-:|---|
| Des tests existent | ❌ | Aucun test. |
| Les tests s'exécutent en une commande | ❌ | Sans objet tant qu'il n'y a pas de tests. |

### Déploiement

| Critère | Note | Constat |
|---|:-:|---|
| Méthode de déploiement connue et documentée | ⚠️ | Dépôt manuel (FTP) mentionné dans le README, mais ni hébergeur ni URL de production documentés. |
| Environnement de staging distinct | ❌ | Uniquement le local et (éventuellement) la production. |

### Monitoring

| Critère | Note | Constat |
|---|:-:|---|
| URL de production monitorée | ❌ | Aucune URL de production renseignée, aucun monitoring. |
| Logs accessibles | ⚠️ | Les messages de contact sont journalisés dans `data/messages.log` (protégé par `.htaccess`), mais pas de logs d'erreur applicatifs centralisés. |

## Bilan

Après les corrections faites pendant ce TP :

| ✅ OK | ⚠️ Partiel | ❌ Absent |
|:-:|:-:|:-:|
| 4 | 4 | 5 |

(Avant le TP : 2 ✅ · 6 ⚠️ · 5 ❌)

## Mes 3 priorités d'amélioration

1. **Protéger la branche `main`** — GitHub › Settings › Branches › *Add rule* sur `main` : exiger une pull request avant merge et bloquer les force-push. Travailler ensuite sur des branches `feature/...`.
2. **Ajouter des tests automatisés** — extraire la validation du formulaire de `contact-handler.php` dans une fonction pure, la tester avec PHPUnit (`composer require --dev phpunit/phpunit`, puis `vendor/bin/phpunit`), et lancer les tests + `php -l` à chaque push via GitHub Actions.
3. **Documenter et automatiser le déploiement, puis surveiller la prod** — choisir un hébergeur, noter l'URL de production dans le README, déployer via GitHub Actions (FTP/SFTP), et ajouter une sonde de disponibilité (UptimeRobot, gratuit).

## Autres points relevés

- `CV_Chaudet_Lucas.pdf` est proposé au téléchargement sur `index.php` et `contact.php`, mais le fichier n'existe pas dans le dépôt (lien cassé).
- `robots.txt` et `sitemap.xml` sont vides.
- L'adresse e-mail du formulaire est codée en dur dans `includes/contact-handler.php` ; elle pourrait passer dans une variable d'environnement (`.env`) avec un `.env.example` versionné.
