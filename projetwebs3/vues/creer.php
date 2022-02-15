<?php
	require_once("../modeles/Utilisateur.php");
	require_once("../modeles/Bd.php");

    session_start();
    if(!isset($_SESSION['logged'])){header("Location: ./connexion.php");}

?>

<!DOCTYPE html>
<html>
<head>

	<title>G4V - Créer un groupe</title>
    <link rel="stylesheet" href="../public/css/creer.css"/>
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
                <h3 class="group-titleh3">Information du groupe</h3>
                <hr class="group-hr"/>
                <div class="group-formulaire">
                    <form method="POST" action="../controleurs/control_groupCreation.php">

                        <h2 class="group-titleh2">Nom du groupe</h2>
                        <hr class="group-hr"/>
                        <p class="guide"><b>Guide :</b> saisir un nom avec moins de <b>20</b> caractères.</p>
                        <input type="text" name="groupName" id="groupName" class="form-control inputform" placeholder="Aa" required/>

                        <h2 class="group-titleh2">Description du groupe</h2>
                        <hr class="group-hr"/>
                        <p class="guide"><b>Guide :</b> saisir une description avec moins de <b>60</b> caractères.</p>
                        <input type="text" name="groupDesc" id="groupDesc" class="form-control inputform" placeholder="Aa" required/>
                        
                        <!--<button id="form-groupCreation-1" class="btn " type="button">Valider</button>-->
                        <p class="save" id="save-1">informations sauvegardé</p>

                    
                </div>
            </div>
            <div class="col-sm-6">
                <h3 class="group-titleh3">Ajouter des catégories</h3>
                <hr class="group-hr"/>
                <div class="group-formulaire">
                    <p class="guide"><b>Guide :</b> pour insérer des catégories, espacez chacune d'elles par des ','.</p>
                    <input type="text" name="groupCategory" class="form-control inputform" id="inputCategory" placeholder="Ex : Nature,"/>
                    <div class="categoryView" id="categoryView"> 
                    </div>
                </div>  
                <h3 class="group-titleh3">Inviter des contacts</h3>
                <hr class="group-hr"/>
                <div class="group-formulaire">
                    <p class="guide"><b>Guide :</b> pour inviter des personnes, espacez chacun des e-mails par des ','.</p>
                    <input type="text" name="emailMemberGroup" class="form-control inputform" id="inputEmail" placeholder="Ex : nom.prenom@gmail.com,"/>
                    <div class="emailView" id="emailView"> </div>
                    <!--<button id="form-groupCreation-3" class="btn btn-outline-info" type="button">Confirmer</button>-->
                </div>

                



            </div>

            <input type="submit" class="btn btn-danger finishgroupCreation" value="Finir la création" id="finish"/>
            </form>







        </div>
    </div>













<?php
    include('./footer.php');
?>

</body>
</html>

<style>
    body{background-color: #DCDCDC; }
    .container-fluid{
    min-height: 600px;
    height: auto;
    }


    @media screen and (max-width: 1280px)
    {
        h2
        {
            font-size: 100px;
        }

    }

</style>
<script>

    // input field
    var categoryView = document.getElementById("categoryView");
    var inputCategory = document.getElementById("inputCategory");
    var inputGroupName = document.getElementById("groupName");
    var inputGroupDesc = document.getElementById("groupDesc");
    var formgroupCreation1 = document.getElementById("form-groupCreation-1");
    var formgroupCreation2 = document.getElementById("form-groupCreation-3");
    var finish = document.getElementById("finish");
    var emailView = document.getElementById("emailView");
    var inputEmail = document.getElementById("inputEmail");
    var save = document.getElementById("save-1");

    // end input field
    
    inputCategory.addEventListener('beforeinput', updatecategoryView);
    
    function updatecategoryView(){
        while(categoryView.firstChild){
            categoryView.removeChild(categoryView.firstChild);
        }
        // On récupere le string de inputCategory
        var content = inputCategory.value;
        var categories = content.split(',');
        console.log("salut")
        for(var i = 0; i<categories.length; i++)
            categoryView.innerHTML += "<p class='badge badge-secondary category'>"+categories[i]+"</p>";
    }

    
    inputEmail.addEventListener('beforeinput', updateEmailView);

    function updateEmailView(){
        while(emailView.firstChild){
            emailView.removeChild(emailView.firstChild);
        }
        // On récupere le string de inputCategory
        var content = inputEmail.value;
        var categories = content.split(',');
        console.log("salut")
        for(var i = 0; i<categories.length; i++)
            emailView.innerHTML += "<p class='badge badge-secondary category'>"+categories[i]+"</p>";
    }


    inputGroupName.addEventListener('beforeinput', validationValues);
    inputGroupDesc.addEventListener('beforeinput', validationValues);

    function validationValues(){

        try{
            //Cas d'erreurs 
            if(inputGroupName.value.length > 20)
                throw "le nom dépasse les 20 caractères";
            if(inputGroupDesc.value.length > 60)
                throw "la description dépasse les 60 caractères";
            if(inputGroupName.value.length == 0)
                throw "error";
            if(inputGroupDesc.value.length == 0)
                throw "error";
            
            
            finish.classList.remove("btn-danger");
            finish.classList.add("btn-success");
        }
        catch(e){
            finish.classList.remove("btn-success");
            finish.classList.add("btn-danger");
        }
    }



    /*
    
    
    formgroupCreation2.onclick = function(){
        finish.classList.remove("btn-danger");
        finish.classList.add("btn-success");
    }

    
    formgroupCreation1.onclick = function(){
        try{
            //Cas d'erreurs 
            if(inputGroupName.value.length > 20)
                throw "le nom dépasse les 20 caractères";
            if(inputGroupDesc.value.length > 60)
                throw "la description dépasse les 60 caractères";
            
            formgroupCreation1.style.display = "none";
            save.style.display = "block";




        }catch(e){

        }

    }
    */





</script>