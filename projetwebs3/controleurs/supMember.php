<?php

    require_once("../modeles/Utilisateur.php");
    require_once("../modeles/Bd.php");

    $idGroupe = $_GET['idGroupe'];
    $idUser = $_GET['idUser'];

    //On ouvre une connexion
    $bd = new Bd();
    $co = $bd->ouvrirConnexion();

    $request = "DELETE FROM memberlist WHERE idGroup = ".$idGroupe." AND idUser = ".$idUser." AND idProposition IS NULL";
    $sup = mysqli_query($co,$request);
    echo $request;
    $request2 = "DELETE FROM adminList WHERE idGroup = ".$idGroupe." AND idUser = ".$idUser;
    $sup2 = mysqli_query($co,$request);
    echo $request2;

    header("Location: ../vues/vueGroupe.php?id=$idGroupe");



?>