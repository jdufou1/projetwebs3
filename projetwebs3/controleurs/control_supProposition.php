<?php

    require_once("../modeles/Utilisateur.php");
    require_once("../modeles/Bd.php");

    $idProposition = $_GET['idProposition'];
    $idGroupe = $_GET['idGroupe'];

    //On ouvre une connexion
    $bd = new Bd();
    $co = $bd->ouvrirConnexion();

    $deleteCategory = "DELETE FROM categoryList WHERE idProposition = ".$idProposition;
    $sup1 = mysqli_query($co,$deleteCategory);
    echo $deleteCategory;

    $deleteCommentary = "DELETE FROM commentary WHERE idProposition = ".$idProposition;
    $sup2 = mysqli_query($co,$deleteCommentary);
    echo $deleteCommentary;

    $deleteLike = "DELETE FROM JLIKE WHERE idProposition = ".$idProposition;
    $sup5 = mysqli_query($co,$deleteLike);

    $deleteReport = "DELETE FROM REPORTPROPOSITION WHERE idProposition = ".$idProposition;
    $sup3 = mysqli_query($co,$deleteReport);
    echo $deleteReport;

    $deleteProposition = "DELETE FROM PROPOSITION WHERE idProposition = ".$idProposition;
    $sup4 = mysqli_query($co,$deleteProposition);
    echo $deleteProposition;
    header("Location: ../vues/vueGroupe.php?id=$idGroupe");
    ?>