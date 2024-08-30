<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Envoyer un courrier électronique</title>
    <style>
      h1 { font-family: verdana,arial,helvetica,sans-serif ; font-size: 100% ; margin-top: 20pt }
    </style>
  </head>
  <body>
    <div>
    
    <h1>Exemple de message simple</h1>
    <?php
    // Destinataire.
    $destinataire = 'olivier@diane.priv';
    // Objet.
    $objet = "Inscription à monSite.com";
    // Message.
    $message  = "Monsieur Heurtel,\n";
    $message .= "Nous vous remercions pour votre inscription sur note site.\n";
    $message .= "Nous espérons que ce site répondra à vos attentes.\n";
    $message .= "Le webmaster.\n";
    // Envoi.
    // $ok = mail($destinataire,$objet,$message);
    echo 'Remarque : la ligne de code permettant d\'envoyer le mail est en commentaire.<br />';
    ?>

    <h1>Exemple de message plus complexe</h1>
    <?php
    // Deux destinataires séparés par une virgule.
    $destinataires = 'olivier@diane.priv,xavier@zeus.priv';
    // Objet.
    $objet = 'Inscription au marathon';
    // Message.
    $message  = "Olivier, Xavier,\n";
    $message .= "Nous vous confirmons votre inscription au\n";
    $message .= "marathon le dimanche 11 avril.\n";
    $message .= "Le départ sera donné à 8h45.\n\n";
    $message .= "Les organisateurs.\n";
    // En-têtes supplémentaires.
    $entêtes  = "From: \"Inscription\" <contact@marathon.fr>\r\n";
    $entêtes .= "Reply-To: \"Inscription\" <contact@marathon.fr>\r\n";
    $entêtes .= "Content-Type: text/plain; charset=utf-8\r\n";
    $entêtes .= "X-Priority: 1\r\n";
    // Envoi.
    // $ok = mail($destinataires,$objet,$message,$entêtes);
    echo 'Remarque : la ligne de code permettant d\'envoyer le mail est en commentaire.<br />';
    ?>

    <h1>Message au format HTML</h1>
    <?php
    // Destinataires.
    $destinataires = 'xavier@zeus.priv';
    // Objet.
    $objet = 'Bonjour !';
    // En-têtes supplémentaires.
    $entêtes  = "From: \"Olivier\" <olivier@diane.com>\r\n";
    $entêtes .= "MIME-Version: 1.0\r\n";
    $entêtes .= "Content-Type: text/html; charset=utf-8\r\n";
    $entêtes .= "Content-Transfer-Encoding: 8bit\r\n";
    // Message (HTML).
    $message  = "<html>\n";
    $message .= "<head><title>Bonjour !</title></head>\n";
    $message .= "<body>\n";
    $message .= "<font color=\"green\">Bonjour !</font>\n";
    $message .= "</body>\n";
    $message .= "</html>\n";
    // Envoi.
    // $ok = mail($destinataires,$objet,$message,$entêtes);
    echo 'Remarque : la ligne de code permettant d\'envoyer le mail est en commentaire.<br />';
    ?>

    <h1>Message avec pièce jointe</h1>
    <?php
    // Destinataires.
    $destinataires = 'xavier@zeus.priv';
    // Objet.
    $objet = 'Bonjour !';
    // En-têtes supplémentaires.
    $entêtes  = '';
    // -> origine du message
    $entêtes .= "From: \"Olivier\" <olivier@diane.com>\r\n";
    // -> message au format Multipart MIME
    $entêtes .= "MIME-Version: 1.0\r\n";
    $entêtes .= "Content-Type: multipart/mixed; ";
    $entêtes .= "boundary=\"=O=L=I=V=I=E=R=\"\r\n";
    // Message.
    $message  = '';
    // -> première partie du message (texte proprement dit)
    //    -> en-tête de la partie
    $message .= "--=O=L=I=V=I=E=R=\r\n";
    $message .= "Content-Type: text/plain; ";
    $message .= "charset=utf-8\r\n ";
    $message .= "Content-Transfer-Encoding: 8bit\r\n";
    $message .= "\r\n"; // ligne vide
    //    -> données de la partie
    $message .= "Voir la pièce jointe.\r\n";
    $message .= "\r\n"; // ligne vide
    // -> deuxième partie du message (pièce-jointe)
    //    -> en-tête de la partie
    $message .= "--=O=L=I=V=I=E=R=\r\n";
    $message .= "Content-Type: application/octet-stream; ";
    $message .= "name=\"PJ.DOC\"\r\n";
    $message .= "Content-Transfer-Encoding: base64\r\n";
    $message .= "Content-Disposition: attachment; ";
    $message .= "filename=\"pj.doc\"\r\n";
    $message .= "\r\n"; // ligne vide
    //    -> lecture du fichier correspond à la pièce jointe
    $données = file_get_contents('../documents/pj.doc');
    //    -> encodage et découpage des données
    $données = chunk_split(base64_encode($données));
    //    -> données de la partie (intégration dans le message)
    $message .= "$données\r\n";
    $message .= "\r\n"; // ligne vide
    // Délimiteur de fin du message.
    $message .= "--=O=L=I=V=I=E=R=--\r\n";
    // Envoi du message.
    // $ok = mail($destinataires,$objet,$message,$entêtes);
    echo 'Remarque : la ligne de code permettant d\'envoyer le mail est en commentaire.<br />';
    ?>                

    </div>
  </body>
</html>