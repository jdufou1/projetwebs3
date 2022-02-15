<?php

    require_once("../modeles/Utilisateur.php");
    require_once("../modeles/Bd.php");
    require_once("./mail.php");
    session_start();

    //On ouvre une connexion
    $bd = new Bd();
    $co = $bd->ouvrirConnexion();

    $idUser = $_GET['idUser'];
    $_SESSION['validationEmail'] = 1;
    $update = "UPDATE JUSER SET validationEmail = 1 WHERE idUser = ".$idUser;

    $request = mysqli_query($co,$update);

?>

<div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
            </div>

            <div class="col-sm-4">
                <div class="group">
                    <p>Vous avez valider votre email avec success ! </p>
                    <a href="http://projetwebs3.alwaysdata.net/vues/accueil.php">Retourner sur le site</a>
                </div>
            </div>
            <div class="col-sm-4">
            </div>
        </div>
</div>

<style>
body{ 
    background-color: #DCDCDC; 

}
.p{
    margin: auto;
}


.container-fluid{
    min-height: 600px;
    height: auto;
}

.group{
    margin-top: 30%;
    padding: 3px;
    width: auto;
    display: block;
    border: solid RGB(8, 158, 228) 2px;
    font-family: 'Arial';
    margin-bottom: 5px;
    border-radius: 2px;
    background-color: rgba(19, 132, 184,0.6);
}

</style>