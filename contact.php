<?php require 'includes/contact-handler.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page de contact portfolio de Chaudet Lucas, développeur web spécialisé en HTML/CSS/JavaScript. Contactez-moi pour discuter de projets, collaborations ou toute autre question liée à mon travail et mes compétences.">
    <link rel="stylesheet" href="style.css">
    <title>Chaudet Lucas - Contact</title>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <main>
        <section class="page-title reveal">
            <h2>Contact</h2>
        </section>

        <section class="reveal">
            <h2>Me contacter</h2>
            <ul class="contact-list">
                <li>
                    <span class="label">Adresse</span>
                    9 rue de l'Huilerie, 53230 Cossé-le-Vivien
                </li>
                <li>
                    <span class="label">Téléphone</span>
                    <a href="tel:+33624665287">06 24 66 52 87</a>
                </li>
                <li>
                    <span class="label">E-mail</span>
                    <a href="mailto:chaudetlucas@gmail.com">chaudetlucas@gmail.com</a>
                </li>
                <li>
                    <span class="label">Permis</span>
                    Permis B + véhiculé
                </li>
            </ul>
        </section>

        <section class="reveal">
            <h2>Envoyer un message</h2>

            <?php if ($success): ?>
                <p class="form-alert form-alert-success" role="status">
                    Votre message a bien été envoyé, merci ! Je vous répondrai dès que possible.
                </p>
            <?php elseif (!empty($errors)): ?>
                <p class="form-alert form-alert-error" role="alert">
                    Le formulaire contient des erreurs, merci de les corriger ci-dessous.
                </p>
            <?php endif; ?>

            <form class="contact-form" action="contact.php#contact-form" method="post" id="contact-form" novalidate>
                <div class="form-row">
                    <label for="name">Nom</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($old['name']) ?>" required minlength="2">
                    <?php if (!empty($errors['name'])): ?><span class="field-error"><?= htmlspecialchars($errors['name']) ?></span><?php endif; ?>
                </div>

                <div class="form-row">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($old['email']) ?>" required>
                    <?php if (!empty($errors['email'])): ?><span class="field-error"><?= htmlspecialchars($errors['email']) ?></span><?php endif; ?>
                </div>

                <div class="form-row">
                    <label for="subject">Sujet</label>
                    <input type="text" id="subject" name="subject" value="<?= htmlspecialchars($old['subject']) ?>" required>
                    <?php if (!empty($errors['subject'])): ?><span class="field-error"><?= htmlspecialchars($errors['subject']) ?></span><?php endif; ?>
                </div>

                <div class="form-row">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="6" required minlength="10"><?= htmlspecialchars($old['message']) ?></textarea>
                    <?php if (!empty($errors['message'])): ?><span class="field-error"><?= htmlspecialchars($errors['message']) ?></span><?php endif; ?>
                </div>

                <!-- Piège à robots : champ caché, ne doit jamais être rempli par un humain -->
                <div class="form-row honeypot" aria-hidden="true">
                    <label for="website">Site web</label>
                    <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                </div>

                <button type="submit" name="contact_submit" value="1" class="btn btn-primary">Envoyer le message</button>
            </form>
        </section>

        <section class="reveal">
            <h2>Centres d'intérêt</h2>
            <div class="tags">
                <span class="tag">Jeux vidéo</span>
                <span class="tag">Lecture</span>
                <span class="tag">Programmation</span>
            </div>
        </section>

        <section class="reveal">
            <div class="cta-group">
                <a href="CV_Chaudet_Lucas.pdf" class="btn btn-primary" download>Télécharger mon CV</a>
            </div>
        </section>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
