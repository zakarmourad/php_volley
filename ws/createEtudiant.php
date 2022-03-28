<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
 include_once '../racine.php';
 chdir("..");
 include_once 'service/EtudiantService.php';
 include_once RACINE.'/service/EtudiantService.php';
 create();
 //extract($_POST);
 $es = new EtudiantService();
 $es->create(new Etudiant(1, $_POST['nom'], $_POST['prenom'], $_POST['ville'], $_POST['sexe']));
  header('Content-type: application/json');
 echo json_encode($es->findAllApi());
}
function create(){
 
}
