<?php
function deplacerFichiersParExtension($chemin) {
    if (!is_dir($chemin)) {
        echo "Le chemin spécifié n'est pas un dossier.";
        return;
    }

    $fichiers = array_diff(scandir($chemin), array('.', '..'));

    foreach ($fichiers as $fichier) {
        $cheminFichier = $chemin . '/' . $fichier;

        if (is_file($cheminFichier)) {
            $extension = pathinfo($cheminFichier, PATHINFO_EXTENSION);
            $nouveauDossier = $chemin . '/' . $extension;

            if (!is_dir($nouveauDossier)) {
                mkdir($nouveauDossier);
            }

            rename($cheminFichier, $nouveauDossier . '/' . $fichier);
        }
    }
}

// Utilisation de la fonction
deplacerFichiersParExtension('Folder_test');
