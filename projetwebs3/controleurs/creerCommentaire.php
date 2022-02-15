<?php
    require_once("../modeles/Utilisateur.php");
    require_once("../modeles/Bd.php");

    session_start();

    $textComment = $_POST['textComment'];
    $idProposition = $_GET['idProposition'];
    $idGroupe = $_GET['idGroupe'];
    $date = date("Y-m-d");

    $jcommentRequest = "INSERT INTO JCOMMENT(textComment,photoComment,dateComment)
                        VALUES('".$textComment."',' ','".$date."')";
    //On ouvre une connexion
    $bd = new Bd();
    $co = $bd->ouvrirConnexion();

    $resultjcomment = mysqli_query($co,$jcommentRequest);

    // Obtenir l'id du commentaire créé

    $searchIdcomment = "SELECT idComment FROM JCOMMENT WHERE dateComment = '".$date."' AND textComment = '$textComment'";
    echo $searchIdcomment;
    $resultSearchComment= mysqli_query($co,$searchIdcomment);

    while($donnee = mysqli_fetch_array($resultSearchComment)){ $idComment = $donnee['idComment'];}

    $commentaryRequest = "INSERT INTO commentary(idUser,idProposition,idComment)
                            VALUES(".$_SESSION['idUser'].",".$idProposition.",".$idComment.")";
    $resultcommentary = mysqli_query($co,$commentaryRequest);

    header("Location: ../vues/vueGroupe.php?id=$idGroupe");










?>