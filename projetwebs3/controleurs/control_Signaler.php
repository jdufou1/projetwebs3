<?php

    require_once("../modeles/Utilisateur.php");
    require_once("../modeles/Bd.php");
    require_once("./mail.php");

    session_start();
    if(!isset($_SESSION['logged'])){header("Location: ./connexion.php");}

    $bd = new Bd();
    $co = $bd->ouvrirConnexion();

    $idProposition = $_GET['idProposition'];
    $idGroupe = $_GET['idGroupe'];

    $insertReport = "INSERT INTO REPORTPROPOSITION(idUser,idProposition)
                    VALUES(".$_SESSION['idUser'].",".$idProposition.")";

    $request = mysqli_query($co,$insertReport);

    header("Location: ../vues/vueGroupe.php?id=$idGroupe");



?>