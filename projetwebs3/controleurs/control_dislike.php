<?php

    require_once("../modeles/Utilisateur.php");
    require_once("../modeles/Bd.php");
    require_once("./mail.php");

    session_start();
    if(!isset($_SESSION['logged'])){header("Location: ./connexion.php");}

    // Récupération de données

    $idProp = $_GET['idProposition'];
    $idGroupe = $_GET['idGroupe'];
    
    // requete update

    $insertRequest = "INSERT JLIKE(idUser,idProposition,voteValue)
                      VALUES(".$_SESSION['idUser'].",".$idProp.",0)";

    echo $insertRequest;

    // Traitement

    $bd = new Bd();
    $co = $bd->ouvrirConnexion();
    
    $request = mysqli_query($co,$insertRequest);

    
    header("Location: ../vues/vueGroupe.php?id=$idGroupe");


?>