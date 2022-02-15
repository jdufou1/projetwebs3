<?php

    require_once("../modeles/Utilisateur.php");
    require_once("../modeles/Bd.php");
    require_once("./mail.php");

    session_start();
    if(!isset($_SESSION['logged'])){header("Location: ./connexion.php");}

    $bd = new Bd();
    $co = $bd->ouvrirConnexion();

    $idComment = $_GET['idComment'];
    $idGroupe = $_GET['idGroupe'];

    $insertReport = "INSERT INTO REPORTCOMMENT(idUser,idComment)
                    VALUES(".$_SESSION['idUser'].",".$idComment.")";

    $request = mysqli_query($co,$insertReport);

    header("Location: ../vues/vueGroupe.php?id=$idGroupe");



?>