<?php
function deplacerFichiers(string $chemin, int $maxFichiers): void {
    if (!is_dir($chemin)) {
        echo "Le chemin spécifié n'est pas un dossier.";
        return;
    }

    $fichiers = array_diff(scandir($chemin), array('.', '..'));
    $fichier_existant_chemin = array_filter(scandir($chemin), function ($fichier) {
        return !is_dir($fichier);
    });
    $nb_fichiers = count($fichier_existant_chemin);
    echo "nombre de fichiers: $nb_fichiers".PHP_EOL;
    $numDossier = 1;

    foreach ($fichiers as $fichier) {
        $cheminFichier = $chemin . '/' . $fichier;
        echo "$cheminFichier".PHP_EOL;
        if (is_file($cheminFichier)) {
            $nouveauDossier = create_folder_not_exist($chemin, $numDossier);
            $fichier_existant = array_filter(scandir($nouveauDossier), function($fichier) {
                return !is_dir($fichier);
            });
            $nb_fichier_existant = count($fichier_existant);

            if ($nb_fichier_existant >= $maxFichiers) {
                $numDossier++;
                $nouveauDossier = create_folder_not_exist($chemin, $numDossier);
                rename($cheminFichier, $nouveauDossier . '/' . $fichier);
            } else {
                rename($cheminFichier, $nouveauDossier . '/' . $fichier);
            }
        }
    }
}

function create_folder_not_exist(string $chemin, int $suffix): string {
    $nouveauDossier = $chemin . '/sousdossier' . $suffix;
    if (!is_dir($nouveauDossier)) {
        mkdir($nouveauDossier);
    }
    return $nouveauDossier;
}

// Utilisation de la fonction
deplacerFichiers('../Interview/test_folder', 3);
