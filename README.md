# Portfolio BTS SIO — Chaudet Lucas

Portfolio personnel réalisé dans le cadre du BTS SIO option SLAM.
Site PHP sans framework ni base de données : présentation, projets, compétences et formulaire de contact.

## Prérequis

- PHP 8.1+ (extension `mbstring` activée)
- Git
- Pour la production : un hébergement Apache + PHP (le fichier `data/.htaccess` protège le dossier des logs)

## Installation

```bash
git clone https://github.com/LucasChaudet/Portfolio.git
cd Portfolio
php -S localhost:8000
```

Ouvrir ensuite <http://localhost:8000> dans un navigateur.

Aucune dépendance à installer, aucune configuration `.env` n'est nécessaire.

## Structure du projet

```
.
├── index.php               # Page d'accueil
├── projet.php              # Liste des projets
├── competence.php          # Compétences
├── contact.php             # Coordonnées + formulaire de contact
├── includes/
│   ├── header.php          # En-tête et menu de navigation (commun à toutes les pages)
│   ├── footer.php          # Pied de page + chargement de script.js
│   └── contact-handler.php # Validation et envoi du formulaire de contact
├── data/
│   └── .htaccess           # Interdit l'accès web au dossier ; messages.log y est écrit (non versionné)
├── style.css               # Styles (thème clair / sombre, responsive)
├── script.js               # Menu mobile, thème, animations, bouton retour en haut
├── robots.txt
└── sitemap.xml
```

## Lancer avec Docker

Seul prérequis : [Docker Desktop](https://www.docker.com/products/docker-desktop/) (ou Docker Engine + Compose).

```bash
git clone https://github.com/LucasChaudet/Portfolio.git
cd Portfolio
cp .env.example .env
docker compose up -d
```

Ouvrir ensuite <http://localhost:8080> (port modifiable via `WEB_PORT` dans `.env`).

Arrêter le site :

```bash
docker compose down
```

## Fonctionnement du formulaire de contact

À l'envoi, `includes/contact-handler.php` valide les champs, envoie un e-mail via `mail()`
(nécessite un serveur mail configuré chez l'hébergeur) et journalise le message dans
`data/messages.log` en secours. En local, `mail()` échoue silencieusement : consulter ce fichier.

## Déploiement

Pas encore automatisé : les fichiers sont à copier sur l'hébergement PHP (FTP / SFTP).
Voir [AUDIT-DEVOPS.md](AUDIT-DEVOPS.md) pour les axes d'amélioration.

## Contributeurs

- Lucas Chaudet — [@LucasChaudet](https://github.com/LucasChaudet)
