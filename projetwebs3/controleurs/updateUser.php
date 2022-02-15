<?php
    session_start();
    require_once("../modeles/Utilisateur.php");
    require_once("../modeles/Bd.php");
    require_once("./mail.php");

    // testNameUser-1
    //On ouvre une connexion
    $bd = new Bd();
    $co = $bd->ouvrirConnexion();

    if(isset($_POST['name'])){
        $name = $_POST['name'];
        $request = "UPDATE JUSER SET nameUser = '".$name."' WHERE idUser = ".$_SESSION['idUser'];
        $result = mysqli_query($co,$request) or die ("<br>Requête sur les infos de l'utilisateur impossible : ".mysqli_error($co));
        $_SESSION['nameUser'] = $name;
    }

    if(isset($_POST['firstName'])){
        $firstName = $_POST['firstName'];
        $request = "UPDATE JUSER SET firstNameUser = '".$firstName."' WHERE idUser = ".$_SESSION['idUser'];
        $result = mysqli_query($co,$request) or die ("<br>Requête sur les infos de l'utilisateur impossible : ".mysqli_error($co));
        $_SESSION['firstNameUser'] = $firstName;
    }
    if(isset($_POST['login'])){
        $login = $_POST['login'];
        $request = "UPDATE JUSER SET loginUser = '".$login."' WHERE idUser = ".$_SESSION['idUser'];
        $result = mysqli_query($co,$request) or die ("<br>Requête sur les infos de l'utilisateur impossible : ".mysqli_error($co));
        $_SESSION['loginUser'] = $login;
    }
    if(isset($_POST['pwd'])){
        $pwd = $_POST['pwd'];
        $request = "UPDATE JUSER SET pwdUser = '".$pwd."' WHERE idUser = ".$_SESSION['idUser'];
        $result = mysqli_query($co,$request) or die ("<br>Requête sur les infos de l'utilisateur impossible : ".mysqli_error($co));
        $_SESSION['pwdUser'] = $pwd;
    }
    if(isset($_POST['mail'])){
        // Envoie du mail de validation du compte:
        mailValidation($_SESSION['idUser'],$_SESSION['nameUser'],$_SESSION['firstNameUser'],$_POST['mail']);
        $mail = $_POST['mail'];
        $request = "UPDATE JUSER SET mailUser = '".$mail."' WHERE idUser = ".$_SESSION['idUser'];
        $result = mysqli_query($co,$request) or die ("<br>Requête sur les infos de l'utilisateur impossible : ".mysqli_error($co));
        $_SESSION['email'] = $mail;
    }
    //echo 'salut je suis dans le controleurs'.$_POST['name'];
?>