<?php
	require_once("../modeles/Utilisateur.php");
	require_once("../modeles/Bd.php");

    session_start();
    if(!isset($_SESSION['logged'])){header("Location: ./connexion.php");}

?>

<!DOCTYPE html>
<html>
<head>

<title>G4V - Paramètres</title>
    <link rel="stylesheet" href="../public/css/accueil.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
</head>
<body>

    <!-- inclure le header -->
    <?php
        include('./header.php');
    ?>

    <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="group-titleh3">Nom</h3>
                    <hr class="group-hr"/> 
                    <?php  echo $_SESSION['nameUser']; ?>
                    <a href="#name" class="name" id="name">mettre à jour</a>
                    <div class="name"></div>

                    <h3 class="group-titleh3">Prénom</h3>
                    <hr class="group-hr"/> 
                    <?php  echo $_SESSION['firstNameUser']; ?>
                    <a href="#fstname" class="fstname" id="fstnamev">mettre à jour</a>
                    <div class="fstname"></div>

                    <h3 class="group-titleh3">Login</h3>
                    <hr class="group-hr"/>
                    <?php  echo $_SESSION['loginUser']; ?> 
                    <a href="#login" class="login" id="login">mettre à jour</a>
                    <div class="login"></div>

                    <h3 class="group-titleh3">Mot de passe</h3>
                    <hr class="group-hr"/> 
                    <?php  echo $_SESSION['pwdUser']; ?>
                    <a href="#pwd" class="pwd"  id="pwd">mettre à jour</a>
                    <div class="pwd"></div>

                    <h3 class="group-titleh3">Adresse mail</h3>
                    <hr class="group-hr"/> 
                    <?php  echo $_SESSION['email']; 
                    if($_SESSION['validationEmail'] == 0){
                        echo '<span class="nV"><b> (non validé) </b></span>';
                    }else{
                        echo '<span class="V"><b> (validé) </b></span>';
                    }
                    
                    ?>
                    <a href="#mail" class="mail" id="mail">mettre à jour</a>
                    <div class="mail"></div>

                    <h3 class="group-titleh3">Photo de profil</h3>
                    <hr class="group-hr"/>
                     

                    <?php  
                           if( $_SESSION['profilPic'] == "../public/img/defaultPictureHomme.png"){
                                echo ' Vous n\'avez pas de photo de profil.';
                           }
                           else{
                                echo '<img src="'.$_SESSION['profilPic'].'"/>';
                           }
                    ?>
                    <a href="#" class="pic">mettre à jour</a>
                    <div class="pic"></div>


                </div>

            </div>
    </div>

    







    <!-- inclure le footer -->

    <?php include('./footer.php'); ?>

</body>

</html>

<style>

    h2{color: #696969;}
    body{background-color: #DCDCDC; }
    .container-fluid{
    min-height: 600px;
    height: auto;
    }

    .nV{
        color: red;
    }
    .V{
        color: green;
    }


    @media screen and (max-width: 1280px)
    {
        h2
        {
            font-size: 100px;
        }

    }

    img{
		/* Valeur de base*/
		width:47px;
		height: 69px;


    }

</style>

<script>
    // var globale qui va décrire le contenu modifier
    var content = "none";
    // Récupération de tous les boutons
    var nameR = document.getElementsByClassName("name");
    //var arrName = Array.prototype.slice.call(name);

    var fstname = document.getElementsByClassName("fstname");

    var login = document.getElementsByClassName("login");
    
    var pwd = document.getElementsByClassName("pwd");
    
    var mail = document.getElementsByClassName("mail");
    
    var pic = document.getElementsByClassName("pic");

    // 1 input et 2 boutons valider et annuler
    var input = document.createElement("input");
    var p1 = document.createElement("span");
    var p2 = document.createElement("span");

    // Class & style

    input.classList.add("form-control");
    input.style.width = "auto";
    input.style.display = "inline-block";
    p2.style.marginLeft = "5px";
    p1.style.marginLeft = "5px";
    p1.style.color = "rgb(44, 80, 97)";
    p2.style.color = "rgb(44, 80, 97)";


    // Node

    var p1Node = document.createTextNode("Modifier");
    var p2Node = document.createTextNode("Annuler");

    // AppendChild

    p1.appendChild(p1Node);
    p2.appendChild(p2Node);

    nameR[0].onclick = function(){
        content = "name";
        p1.style.display = "inline-block";
        p2.style.display = "inline-block";
        input.style.display = "inline-block";
        input.type="text";

        input.placeholder="Nouveau nom...";
        nameR[1].appendChild(input);
        nameR[1].appendChild(p1);
        nameR[1].appendChild(p2);
        nameR[0].style.display = "none";
    }
    fstname[0].onclick = function(){
        content = "firstName";
        p1.style.display = "inline-block";
        p2.style.display = "inline-block";
        input.style.display = "inline-block";
        input.type="text";

        input.placeholder="Nouveau prénom...";
        fstname[1].appendChild(input);
        fstname[1].appendChild(p1);
        fstname[1].appendChild(p2);
        fstname[0].style.display = "none";
    }
    login[0].onclick = function(){
        content = "login";
        p1.style.display = "inline-block";
        p2.style.display = "inline-block";
        input.style.display = "inline-block";
        input.type="text";

        input.placeholder="Nouveau login...";
        login[1].appendChild(input);
        login[1].appendChild(p1);
        login[1].appendChild(p2);
        login[0].style.display = "none";
    }
    pwd[0].onclick = function(){
        content = "pwd";
        p1.style.display = "inline-block";
        p2.style.display = "inline-block";
        input.style.display = "inline-block";
        input.type="password";

        input.placeholder="Nouveau mot de passe...";
        pwd[1].appendChild(input);
        pwd[1].appendChild(p1);
        pwd[1].appendChild(p2);
        pwd[0].style.display = "none";
    }
    mail[0].onclick = function(){
        content = "mail";
        p1.style.display = "inline-block";
        p2.style.display = "inline-block";
        input.style.display = "inline-block";
        input.type="text";

        input.placeholder="Nouveau mail...";
        mail[1].appendChild(input);
        mail[1].appendChild(p1);
        mail[1].appendChild(p2);
        mail[0].style.display = "none";
    }

    // fonctions onclick annuler et modifier

    p2.onmouseover = function(){
        p2.style.cursor = "pointer";
        p2.style.color = "rgb(8, 158, 228)";
    }
    p2.onmouseout = function(){
        p2.style.color = "rgb(44, 80, 97)";
        p2.style.transitionDuration = "0.5s";
    }

    p2.onclick = function(){clean();}

    p1.onmouseover = function(){
        p1.style.cursor = "pointer";
        p1.style.color = "rgb(8, 158, 228)";
    }
    p1.onmouseout = function(){
        p1.style.color = "rgb(44, 80, 97)";
        p1.style.transitionDuration = "0.5s";
    }

    p1.onclick = function(){
        var request = new XMLHttpRequest();
        var path = "../controleurs/updateUser.php";
        
        console.log(path);
           
           
           request.onreadystatechange = function() {
                   if (request.readyState === 4 && request.status === 200){
                      console.log("transmis");
                      console.log(request.responseText);
                   }
           }

           request.open('POST',path);
           request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
           // Variables
           request.send(content+"="+input.value);
           
        window.location.reload()
    }

    function clean(){
         //Rétablir les champs initiaux
         nameR[0].style.display = "inline-block";
        fstname[0].style.display = "inline-block";
        login[0].style.display = "inline-block";
        pwd[0].style.display = "inline-block";
        mail[0].style.display = "inline-block";
        pic[0].style.display = "inline-block";

        p1.style.display = "none";
        p2.style.display = "none";
        input.style.display = "none";
    }




</script>