<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page d'accueil portfolio de Chaudet Lucas, étudiant en BTS SIO option SLAM, développeur web spécialisé en HTML/CSS/JavaScript. Découvrez mes projets, compétences et expériences professionnelles.">
    <title>Chaudet Lucas - Accueil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <main>
        <section class="hero reveal">
            <p class="eyebrow">Portfolio BTS SIO — Option SLAM</p>
            <h2>Chaudet <span class="text-gradient">Lucas</span></h2>
            <p class="subtitle">Étudiant en 2ème année de BTS SIO — Option SLAM</p>

            <p class="banner">
                En recherche d'un stage BTS SIO option SLAM<br>
                du lundi 4 janvier au vendredi 19 février 2027.
            </p>

            <div class="cta-group">
                <a href="competence.php" class="btn btn-primary">Voir mes compétences</a>
                <a href="contact.php" class="btn btn-outline">Me contacter</a>
                <a href="CV_Chaudet_Lucas.pdf" class="btn btn-outline" download>Télécharger mon CV</a>
            </div>
        </section>

        <section class="reveal">
            <h2>Profil</h2>
            <p>
                Je suis étudiant en 2ème année de BTS Services Informatiques aux Organisations (SIO),
                option SLAM. Je m'intéresse au développement web, à la gestion de bases de données et
                à la création de logiciels. Je travaille aussi bien en équipe qu'en autonomie.
                J'organise mon travail et mon temps pour être plus productif.
            </p>
        </section>

        <section class="reveal">
            <h2>En bref</h2>
            <div class="card-grid">
                <div class="card">
                    <h3>Formation</h3>
                    <p>BTS SIO option SLAM (2ème année)</p>
                    <p class="stack">Institut d'Informatique Appliquée, Saint-Berthevin</p>
                </div>
                <div class="card">
                    <h3>Développement</h3>
                    <p>HTML, CSS, JavaScript, PHP, WordPress, Bootstrap, C#</p>
                </div>
                <div class="card">
                    <h3>Bases de données</h3>
                    <p>Gestion, création et modélisation de bases de données SQL</p>
                </div>
            </div>
        </section>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
