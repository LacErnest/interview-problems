<?php

require_once("problem1.php");
require_once("problem2.php");
require_once("problem3.php");
require_once("problem4.php");
require_once("problem5.php");
require_once("problem6.php");
require_once("problem7.php");
require_once("question1.php");
require_once("question2.php");
require_once("algo_1.php");


function main(): void {

  // Récupération du chemin d'accès du dossier
  $dossier = "./Folder_test";

  // Appel de la fonction
  listerFichiers($dossier);
    
}

main();
