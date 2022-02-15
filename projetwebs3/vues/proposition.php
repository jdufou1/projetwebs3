<?php
	require_once("../modeles/Utilisateur.php");
	require_once("../modeles/Bd.php");

    session_start();
    if(!isset($_SESSION['logged'])){header("Location: ./connexion.php");}

?>

<!DOCTYPE html>
<html>
<head>

	<title>G4V - Faire une proposition</title>
    <link rel="stylesheet" href="../public/css/creer.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
</head>
<body>

    <!-- inclure le header -->
    <?php
            include('./header.php');
    ?>

    <div class="alert alert-danger" id="alert" role="alert" style="display: none"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"> 
                <h3 class="group-titleh3">Votre Proposition </h3>
                <hr class="group-hr"/>

                <div class="group-formulaire">
                    <form method="POST" action="../controleurs/control_propCreation.php">
                        <h2 class="group-titleh2">Courte description</h2>
                        <hr class="group-hr"/>
                        <p class="guide"><b>Guide :</b> saisir une courte description avec moins de <b>20</b> caractères.</p>
                        <input type="text" name="shortDesc" id="shortDesc" class="form-control inputform" placeholder="Aa" required/>

                        <h2 class="group-titleh2">Contenu</h2>
                        <hr class="group-hr"/>
                        <p class="guide"><b>Guide :</b> saisir un contenu avec moins de <b>60</b> caractères.</p>
                        <input type="text" name="longDesc" id="longDesc" class="form-control inputform" placeholder="Aa" required/>

                        <h2 class="group-titleh2">Type</h2>
                        <hr class="group-hr"/>

                        <div class="input-group mb-3" style="width: auto;">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" id="vote"/>
                                </div>
                            </div>
                            <input type="text" class="form-control" value="vote" style="width: auto;" disabled/>
                        </div>
                        
                        <p class="guide"><b>Guide :</b> si c'est un vote, précisez la date de cloturation.</p>
                        <input type="date" name="date" id="date" class="form-control inputform"/>
                        
                </div>






            </div>
            <div class="col-sm-6">
                <div class="group-formulaire">
                        <h2 class="group-titleh2">Media</h2>
                        <hr class="group-hr"/>
                        <p class="guide"><b>Guide :</b> choisir un media avec les extensions <b>jpg</b>,<b>png</b>,<b>gif</b>.</p>
                        <input type="file" name="file" id="file" class="form-control-file inputform"/>
                
                <?php
                //On ouvre une connexion
                $bd = new Bd();
                $co = $bd->ouvrirConnexion();

                $categories = "SELECT * FROM CATEGORY WHERE idGroup =".$_GET['idGroupe'];
                //echo $categories;

                ?>
                    <h2 class="group-titleh2">Associer à des catégories</h2>
                    <hr class="group-hr"/>
                    <?php
                        $result = mysqli_query($co,$categories);
                        if(mysqli_num_rows($result)<1){
                            echo "<p> Aucune catégorie disponible. </p>";
                        }else{
                            while($donnee = mysqli_fetch_array($result)){
                                echo '<div class="input-group mb-3">';
                                echo '    <div class="input-group-prepend">';
                                echo '       <div class="input-group-text">';
                                echo '        <input type="checkbox" id="'.$donnee["idCategory"].'" class="nameCategory" name="nameCategory">';
                                echo '        </div>';
                                echo '    </div>';
                                echo '    <input type="text" class="form-control " value="'.$donnee["nameCategory"].'" readonly>';
                                echo '</div>';
                                echo '<div class="form-group" style="height:auto;">';
                                echo '    <select class="form-control" name="valueCategories" style="height:auto;">';
                                echo '      <option value="primaire">primaire</option>';
                                echo '      <option value="secondaire" selected>secondaire</option>';
                                echo '    </select>';
                                echo '</div>';

                            }
                        }


                    ?>



                </div>
            </div>

            <input type="button" class="form-control btn-outline-secondary" value="Finir la création" style="width: auto; margin: auto;" id="finish"/>
            </form>

        </div>
    </div>
    <div class="<?php echo $_GET['idGroupe'];?>" id="idGroupe"></div>

    <!-- inclure le footer -->
    <?php
            include('./footer.php');
    ?>
</body>
</html>
<style>
body{ 
    background-color: #DCDCDC; 


}
.container-fluid{
    min-height: 600px;
    height: auto;
}

</style>

<script>

var alert = document.getElementById('alert');

var shortDesc = document.getElementById('shortDesc');

var longDesc = document.getElementById('longDesc');

var vote = document.getElementById('vote');

var date = document.getElementById('date');



var idGroupe = document.getElementById('idGroupe');

var nameCategories = document.getElementsByName("nameCategory");
var valueCategories = document.getElementsByName("valueCategories");

var img;


var finish = document.getElementById('finish');

finish.onclick = function(){

    try{
        var dateA = "0000-00-00";
        if(shortDesc.value == ""){throw 'Veuillez saisir une courte description';}
        if(longDesc.value == ""){throw 'Veuillez saisir un contenu';}
        if(vote.checked == true && date.value == ""){throw 'Veuillez saisir une date de cloturation';}
        if(vote.checked == true){dateA = date.value; }

        img = document.getElementById('file').files[0];
        var req = new XMLHttpRequest();
        var formData = new FormData();
        formData.append("photo", img);      

        //fetch('../controleurs/upload.php', {method: "POST", body: formData});                          
        
        req.onreadystatechange = function() {
                   if (req.readyState === 4 && req.status === 200){
                      console.log("info img : ");
                      console.log(req.responseText);
                   }
        }
        req.open("POST","../controleurs/upload.php");
        //req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        req.send(formData);
        

        var imgPath = "none";

        if(img !== undefined){
            console.log('gerg');
            var imgPath = img.name;
        }
        




        var nameArray = new Array();
        var valueArray = new Array();

        for(var i = 0;i < nameCategories.length; i++){
            nameArray.push(nameCategories[i].id+"-"+nameCategories[i].checked);
        }

        
        for(var i = 0;i < valueCategories.length; i++){
            nameArray[i] += "-"+valueCategories[i].value;
        }
        console.log(nameArray);
        

        var request = new XMLHttpRequest();
        var path = "../controleurs/control_propCreation.php";
        
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
        request.send("shortDesc="+shortDesc.value+"&longDesc="+longDesc.value+"&idGroupe="+idGroupe.className+"&vote="+vote.checked+"&date="+dateA
        +"&categories="+nameArray+"&imgpath=../public/img/users/"+imgPath);

        document.location.href="./vueGroupe.php?id="+idGroupe.className;

        /*
        window.location.reload()
        */

    }catch(e)
    {
        alert.innerHTML = "<p>Erreur lors de la saisie : "+e+"</p>";
        alert.style.display = "block";
    }
}




</script>