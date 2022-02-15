<?php 

    require_once("../modeles/Utilisateur.php");
    require_once("../modeles/Bd.php");
    require_once("./mail.php");

    // Récupération des infos

    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $login = $_POST['login'];
    $pwd = $_POST['passeword'];
    $mail = $_POST['email'];
    $date = date("Y-m-d");
    //On ouvre une connexion
    $bd = new Bd();
    $co = $bd->ouvrirConnexion();

    // Insertion du groupe 

    $insert = "INSERT INTO JUSER(nameUser,firstNameUser,loginUser,pwdUser,inscriptionDate,mailUser,validationEmail,profilPic)
    VALUES('".$name."','".$firstname."','".$login."','".$pwd."','".$date."','".$mail."',0,'../public/img/defaultPictureHomme.png')";

    // Envoie a la bd
    echo $insert;



    $request = mysqli_query($co,$insert);

    // Récupération de l'id du compte créer
    $requeteIdUser = "SELECT * FROM JUSER WHERE pwdUser='$pwd' AND mailUser='$mail'";
    //echo $requeteIdUser;
    $resultIdUser = mysqli_query($co,$requeteIdUser);

    while($donnee = mysqli_fetch_array($resultIdUser)){ 
        $idUser = $donnee['idUser'];
        $validationUser = $donnee['validationEmail'];
    }



    // Connection du compte

    

    session_start();

    $_SESSION["logged"]=true;
    $_SESSION["email"]=$mail;
    $_SESSION["pwd"]=$pwd;
    $_SESSION['co'] = $co;
    $_SESSION['nameUser'] = $name;
    $_SESSION['firstNameUser'] = $firstname;
    $_SESSION['inscriptionDate'] = $date; 
    $_SESSION['validationEmail'] = $validationUser; 
    $_SESSION['profilPic'] = '../public/img/defaultPictureHomme.png';
    $_SESSION['idUser'] = $idUser;
    $_SESSION['pwdUser'] = $pwd;
    $_SESSION['loginUser'] = $login;

    // Envoie du mail de validation du compte:
    mailValidation($idUser,$name,$firstname,$mail);

    header("Location: ../vues/accueil.php");




   








?>