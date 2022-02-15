<?php
    require_once("../modeles/Utilisateur.php");
    require_once("../modeles/Bd.php");
    require_once("./mail.php");

    //session_destroy();
    session_start();

    // Récupération des données

    $idGroupe = $_POST['idGroupe'];
    $emailUser = $_POST['email'];
    $pwdUser = $_POST['pwd'];

    // obtenir l'id du user
    $bd = new Bd();
    $co = $bd->ouvrirConnexion();

    $infoUser = "SELECT * FROM JUSER WHERE mailUser = '".$emailUser."' AND pwdUser = '".$pwdUser."'";
    //echo $infoUser;
    $request1 = mysqli_query($co,$infoUser);
    if(mysqli_num_rows($request1) == 1){
        while($donnee = mysqli_fetch_array($request1)){ $idUser = $donnee['idUser'];}

        // On vérifie que l'utilisateur n'appartient pas au groupe

        $verifGroupe = "SELECT * FROM memberlist WHERE idUser = ".$idUser." AND idGroup = ".$idGroupe." AND idProposition IS NULL";
        //echo $verifGroupe;
        $request2 = mysqli_query($co,$verifGroupe);

        if(mysqli_num_rows($request2) < 1){

            // Insertion du user dans le groupe

            $insert = "INSERT INTO memberlist(idUser,idGroup) VALUES (".$idUser.",".$idGroupe.")";
            $request3 = mysqli_query($co,$insert);
            //
            /*while ($donnee = mysqli_fetch_array($request1)) { 
                $_SESSION['nameUser'] = $donnee['nameUser'];
                $_SESSION['firstNameUser'] = $donnee['firstNameUser'];
                $_SESSION['inscriptionDate'] = $donnee['inscriptionDate']; 
                $_SESSION['validationEmail'] = $donnee['validationEmail']; 
                $_SESSION['profilPic'] = $donnee['profilPic'];
                $_SESSION['idUser'] = $donnee['idUser'];
                $_SESSION['pwdUser'] = $donnee['pwdUser'];
                $_SESSION['loginUser'] = $donnee['loginUser'];
                $_SESSION["logged"]=true;

                // Au cas ou
                $_SESSION["email"]= $donnee['mailUser'];
     
                $_SESSION["pwd"]= $donnee['pwdUser'];
                $_SESSION['co'] = $co;
           }
           */
        }else{
            echo 'Vous appartenez déjà à ce groupe.';
        }
    }else{
        echo 'Mot de passe ou email incorrect.';
    }





?>