<?php
$errors = [];
$success = false;
$old = ['name' => '', 'email' => '', 'subject' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {

    // Honeypot anti-spam : ce champ est masqué en CSS, seul un bot le remplit
    if (!empty($_POST['website'])) {
        $success = true; // on fait croire au bot que ça a marché
    } else {
        $old['name']    = trim($_POST['name'] ?? '');
        $old['email']   = trim($_POST['email'] ?? '');
        $old['subject'] = trim($_POST['subject'] ?? '');
        $old['message'] = trim($_POST['message'] ?? '');

        if ($old['name'] === '' || mb_strlen($old['name']) < 2) {
            $errors['name'] = 'Merci de renseigner votre nom (2 caractères minimum).';
        }

        if ($old['email'] === '' || !filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Merci de renseigner une adresse e-mail valide.';
        }

        if ($old['subject'] === '') {
            $errors['subject'] = 'Merci de renseigner un sujet.';
        }

        if ($old['message'] === '' || mb_strlen($old['message']) < 10) {
            $errors['message'] = 'Votre message doit contenir au moins 10 caractères.';
        }

        if (empty($errors)) {
            $to      = 'chaudetlucas@gmail.com';
            $subject = '[Portfolio] ' . $old['subject'];
            $body    = "Nom : {$old['name']}\n"
                     . "E-mail : {$old['email']}\n\n"
                     . "Message :\n{$old['message']}\n";
            $headers = 'From: portfolio@' . ($_SERVER['SERVER_NAME'] ?? 'localhost') . "\r\n"
                     . 'Reply-To: ' . $old['email'] . "\r\n";

            // Envoi de l'e-mail (nécessite un serveur mail configuré côté hébergeur)
            @mail($to, $subject, $body, $headers);

            // Journalisation locale en secours (utile en développement / si mail() est indisponible)
            $logDir = __DIR__ . '/../data';
            if (!is_dir($logDir)) {
                mkdir($logDir, 0755, true);
            }
            $entry = sprintf(
                "[%s] %s <%s> — %s : %s\n",
                date('Y-m-d H:i:s'),
                $old['name'],
                $old['email'],
                $old['subject'],
                str_replace(["\r", "\n"], ' ', $old['message'])
            );
            @file_put_contents($logDir . '/messages.log', $entry, FILE_APPEND | LOCK_EX);

            $success = true;
            $old = ['name' => '', 'email' => '', 'subject' => '', 'message' => ''];
        }
    }
}
