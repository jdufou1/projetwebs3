<?php
require_once("../modeles/Bd.php");
require_once("../modeles/Utilisateur.php");
session_start();

$email = $_POST['email'];
$pwd = $_POST['pwd'];

$bd = new Bd();
$co = $bd->ouvrirConnexion();

$requete = "SELECT * FROM JUSER WHERE pwdUser='$pwd' AND mailUser='$email'";

$result = mysqli_query($co,$requete) or die ("<br>Execution de la requête impossible ".mysqli_error($co));
if(mysqli_num_rows($result)==1){

     $_SESSION["logged"]=true;

     $_SESSION["email"]=$email;

     $_SESSION["pwd"]=$pwd;
     $_SESSION['co'] = $co;

     $requeteUserInfo = "SELECT * FROM JUSER WHERE pwdUser='$pwd' AND mailUser='$email'";
     $result = mysqli_query($co,$requete) or die ("<br>Requête sur les infos de l'utilisateur impossible : ".mysqli_error($co));
     if(mysqli_num_rows($result)==1){

          while ($donnee = mysqli_fetch_array($result)) { 
               $_SESSION['nameUser'] = $donnee['nameUser'];
               $_SESSION['firstNameUser'] = $donnee['firstNameUser'];
               $_SESSION['inscriptionDate'] = $donnee['inscriptionDate']; 
               $_SESSION['validationEmail'] = $donnee['validationEmail']; 
               $_SESSION['profilPic'] = $donnee['profilPic'];
               $_SESSION['idUser'] = $donnee['idUser'];
               $_SESSION['loginUser'] = $donnee['loginUser']; 
               $_SESSION['pwdUser'] = $donnee['pwdUser']; 
          }
     }



      header("Location: ../vues/accueil.php");
}





else{
$error = "Erreur, login ou mot de passe incorrecte";
header("Location: ../vues/accueil.php");
}
?>

