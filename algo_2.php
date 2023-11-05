<?php
function deplacerFichiers(string $chemin, int $maxFichiers): void {
    if (!is_dir($chemin)) {
        echo "Le chemin spécifié n'est pas un dossier.";
        return;
    }

    $fichiers = array_diff(scandir($chemin), array('.', '..'));
    $numDossier = 1;

    foreach ($fichiers as $fichier) {
        $cheminFichier = $chemin . '/' . $fichier;
        if (is_file($cheminFichier)) {
            $nouveauDossier = create_folder_not_exist($chemin, $numDossier);
            $fichier_existant = get_files($nouveauDossier);
            if (count($fichier_existant) >= $maxFichiers) {
                $numDossier++;
                $nouveauDossier = create_folder_not_exist($chemin, $numDossier);
            } 
            rename($cheminFichier, $nouveauDossier . '/' . $fichier);
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

function get_files(string $path): array
{
    return array_filter(scandir($path), function ($file) {
        return !is_dir($file);
    });
}

// Utilisation de la fonction
deplacerFichiers('../Interview/test_folder', 3);
