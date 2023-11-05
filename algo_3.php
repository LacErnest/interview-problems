<?php
function deplacerFichiersParExtension(string $chemin, int $maxFichiers = PHP_INT_MAX): void {
    if (!is_dir($chemin)) {
        echo "Le chemin spécifié n'est pas un dossier.";
        return;
    }

    $fichiers = array_diff(scandir($chemin), array('.', '..'));
    $extensions_array = array();
    // define a constant named NUM_DOSSIER
    define('NUM_DOSSIER', 1);

    foreach ($fichiers as $fichier) {
        $cheminFichier = $chemin . '/' . $fichier;

        if (is_file($cheminFichier)) {
            $extension = pathinfo($cheminFichier, PATHINFO_EXTENSION);
            $nouveauChemin = $chemin . '/' . $extension;
            if (!array_key_exists($extension, $extensions_array)){
                $extensions_array[$extension] = NUM_DOSSIER;
            } else {
                $fichier_existant = get_files($nouveauChemin.'_'. $extensions_array[$extension]);
                if (count($fichier_existant) >= $maxFichiers) {
                    $extensions_array[$extension] += NUM_DOSSIER;
                }
            }
            $nouveauDossier = create_folder_not_exist($nouveauChemin, $extensions_array[$extension]);
            rename($cheminFichier, $nouveauDossier . '/' . $fichier);
        }
    }
}

function create_folder_if_not_exist(string $chemin, int $suffix): string
{
    $nouveauDossier = $chemin . '_' .$suffix;
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
deplacerFichiersParExtension('Folder_test', 4);
