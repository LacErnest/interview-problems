<?php
declare(strict_types=1);

function listerFichiers(string $chemin, string $cheminRelatif = ''): void
{
    if (!is_dir($chemin)) {
        echo "Le chemin spécifié n'est pas un dossier valide." . PHP_EOL;
        return;
    }

    // Can use new DirectoryIterator with is ->isDot, ->isDir functions
    $fichiers = scandir($chemin);

    foreach ($fichiers as $fichier) {
        if ($fichier !== '.' && $fichier !== '..') {
            $cheminFichier = $chemin . '/' . $fichier;
            $cheminRelatifFichier = $cheminRelatif !== '' ? $cheminRelatif . '/' . $fichier : $fichier;

            if (is_dir($cheminFichier)) {
                echo "Dossier : $cheminRelatifFichier" . PHP_EOL;
                listerFichiers($cheminFichier, $cheminRelatifFichier);
            } else {
                echo "Fichier : $cheminRelatifFichier" . PHP_EOL;
            }
        }
    }
}

// Utilise le dossier courant où ce fichier est situé.
$cheminDossierCourant = "../Interview";
listerFichiers($cheminDossierCourant);
