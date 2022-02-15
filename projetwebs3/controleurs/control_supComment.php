<?php

    require_once("../modeles/Utilisateur.php");
    require_once("../modeles/Bd.php");

    $idComment = $_GET['idComment'];
    $idGroupe = $_GET['idGroupe'];

    //On ouvre une connexion
    $bd = new Bd();
    $co = $bd->ouvrirConnexion();

    $deleteCommentary = "DELETE FROM commentary WHERE idComment = ".$idComment;
    $sup1 = mysqli_query($co,$deleteCommentary);

    $deleteReport = "DELETE FROM REPORTCOMMENT WHERE idComment = ".$idComment;
    $sup2 = mysqli_query($co,$deleteReport);

    $deleteComment = "DELETE FROM JCOMMENT WHERE idComment = ".$idComment;
    $sup3 = mysqli_query($co,$deleteComment);

    header("Location: ../vues/vueGroupe.php?id=$idGroupe");
    ?>