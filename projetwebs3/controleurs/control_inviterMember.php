<?php
    require_once("../modeles/Utilisateur.php");
    require_once("../modeles/Bd.php");
    require_once("./mail.php");

    session_start();
    if(!isset($_SESSION['logged'])){header("Location: ./connexion.php");}

    $idGroupe = $_GET['idGroupe'];
    $email = $_POST['email'];

    $fullNameUser = $_SESSION['firstNameUser']." ".$_SESSION['nameUser'];

    $bd = new Bd();
    $co = $bd->ouvrirConnexion();

    $request = "SELECT * FROM JGROUP WHERE idGroup = ".$idGroupe;
    $result =  mysqli_query($co,$request);

    while($donnee = mysqli_fetch_array($result)){ 
        $nameGroup = $donnee['nameGroup'];
        $descGroup = $donnee['descGroup'];
    }

    newMemberMail($fullNameUser,$email,$nameGroup,$descGroup,$idGroupe);

    header("Location: ../vues/vueGroupe.php?id=$idGroupe");

?>