<?php
$currentPage = basename($_SERVER['PHP_SELF']);

$navLinks = [
    'index.php'      => 'Accueil',
    'projet.php'      => 'Projets',
    'competence.php' => 'Compétences',
    'contact.php'    => 'Contact',
];
?>
<header>
    <div class="header-inner">
        <a href="index.php" class="logo">Chaudet<span>Lucas</span></a>
        <button class="nav-toggle" id="navToggle" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="mainNav">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <nav class="nav" id="mainNav">
            <ul>
                <?php foreach ($navLinks as $href => $label): ?>
                    <li>
                        <a href="<?= htmlspecialchars($href) ?>"
                           class="<?= $currentPage === $href ? 'active' : '' ?>"
                           <?= $currentPage === $href ? 'aria-current="page"' : '' ?>>
                            <?= htmlspecialchars($label) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <button class="theme-toggle" id="themeToggle" aria-label="Changer de thème" type="button">
                <span class="theme-icon" aria-hidden="true">🌙</span>
            </button>
        </nav>
    </div>
</header>
