<?php
	require_once("../modeles/Utilisateur.php");
	require_once("../modeles/Bd.php");

    session_start();
    //if(!isset($_SESSION['logged'])){header("Location: ./connexion.php");}

?>

<!DOCTYPE html>
<html>
<head>

	<title>G4V - Rejoindre un groupe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
</head>
<body>

    <div class="alert alert-danger" id="alert" role="alert" style="display: none"></div>
    <div class="alert alert-success" id="success" style="display: none" role="alert"></div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
            </div>

            <div class="col-sm-4">
            <div class="group">
            <?php
                //On ouvre une connexion
                $bd = new Bd();
                $co = $bd->ouvrirConnexion();

                $idGroupe = $_GET['id'];
                $infoGroup = "SELECT * FROM JGROUP WHERE idGroup=".$idGroupe;

                $result = mysqli_query($co,$infoGroup);

                if(mysqli_num_rows($result)<1){ echo "<p> Une erreur c'est produite. </p>"; }
                else{
                    while($donnee = mysqli_fetch_array($result)){
                        echo '<p><b>Invitation au groupe </b></p>';
                        echo "<p><span style='color: rgb(44, 80, 97);'>Nom :</span> ".$donnee['nameGroup']."</p>";
                        echo "<p><span style='color: rgb(44, 80, 97);'>Description :</span> ".$donnee['descGroup']."</p>";
                    }
                }

            ?>
                <p style='color: rgb(44, 80, 97);'>Connectez-vous pour rejoindre le groupe : </p>
                <input type="text" id="email" class="form-control" style="width: auto; display: inline-block;" placeholder="Email" required/>
                <input type="password" id="pwd" class="form-control" style="width: auto; display: inline-block;" placeholder="Mot de passe" required/>
                <button type="button" id="submit" class="form-control" style="width: auto; display: inline-block; margin-top: 5px;">Rejoindre</button>

            </div>
            </div>

            <div class="col-sm-4">
            </div>

        </div>
    </div>
    <div  class="<?php echo $_GET['id']; ?>" id="idGroupe"></div>

</body>

</html>

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


<script>

    // On récupère les ids

    var submit = document.getElementById('submit');
    var idGroupe = document.getElementById('idGroupe');
    var alert = document.getElementById('alert');
    var success = document.getElementById('success');

    submit.onclick = function(){
        try{

            var email = document.getElementById('email').value;
            var pwd = document.getElementById('pwd').value;
            var request = new XMLHttpRequest(); 

            request.onreadystatechange = function() {
                try{

                    if (request.readyState === 4 && request.status === 200){
                      console.log("transmis");
                      if(request.responseText != ""){
                        console.log(request.responseText);
                          throw request.responseText;
                        }
                      console.log(request.responseText);
                   }
                   success.innerHTML = "<p>Groupe rejoint avec success.</p>";
                   success.style.display = "block";
                }
                catch(e){
                    console.log(e);
                    alert.innerHTML = "<p>Erreur lors de la saisie : "+e+"</p>";
                    alert.style.display = "block";
                }
                   
           }
           request.open('POST',"../controleurs/control_rejoindreGroupe.php");
           request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
           // Variables
           request.send("idGroupe="+idGroupe.className+"&email="+email+"&pwd="+pwd);

           
           //document.location.href="./vueGroupe.php?id="+idGroupe;

        }catch(e){
            console.log(e);
            alert.innerHTML = "<p>Erreur lors de la saisie : "+e+"</p>";
            alert.style.display = "block";
        }
    }




</script>