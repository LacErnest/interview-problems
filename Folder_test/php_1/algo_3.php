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
                $fichier_existant = array_filter(scandir($nouveauChemin.'_'. $extensions_array[$extension]), function ($fichier) {
                    return !is_dir($fichier);
                });
                $nb_fichier_existant = count($fichier_existant);
                if ($nb_fichier_existant >= $maxFichiers) {
                    $extensions_array[$extension] += NUM_DOSSIER;
                }
            }
            $nouveauDossier = create_folder_not_exist($nouveauChemin, $extensions_array[$extension]);
            $fichier_existant = array_filter(scandir($nouveauDossier), function ($fichier) {
                return !is_dir($fichier);
            });
            $nb_fichier_existant = count($fichier_existant);

            if ($nb_fichier_existant >= $maxFichiers) {
                $nouveauDossier = create_folder_not_exist($nouveauChemin, $extensions_array[$extension]);
                rename($cheminFichier, $nouveauDossier . '/' . $fichier);
            } else {
                rename($cheminFichier, $nouveauDossier . '/' . $fichier);
            }
        }
    }
}

function create_folder_not_exist(string $chemin, int $suffix): string
{
    $nouveauDossier = $chemin . '_' .$suffix;
    if (!is_dir($nouveauDossier)) {
        mkdir($nouveauDossier);
    }
    return $nouveauDossier;
}

// Utilisation de la fonction
deplacerFichiersParExtension('Folder_test', 4);
