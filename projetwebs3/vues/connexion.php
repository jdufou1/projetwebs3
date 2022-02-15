<!DOCTYPE html>
<html>
<head>

	<title>Accueil - connexion</title>
    <link rel="stylesheet" href="../public/css/accueil.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
</head>
<body>

<?php
include('./header.php');


require_once("../modeles/Utilisateur.php");
require_once("../modeles/Bd.php");
?>



    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
            <h3 class="group-titleh3" style="font-size: 170%;">Les meilleurs groupes</h3>
                    <hr class="group-hr"/>
                    <?php
                        //On ouvre une connexion
                        $bd = new Bd();
                        $co = $bd->ouvrirConnexion();
                        // requete pour avoir les  5 groupes avec le plus de proposition:
                        $resultGroup = mysqli_query($co,"SELECT COUNT(*) AS NbredeProposition , G.idGroup, G.nameGroup,G.dateGroup,G.descGroup 
                                                         FROM JGROUP G, memberlist MB 
                                                         WHERE G.idGroup = MB.idGroup 
                                                         GROUP BY G.idGroup 
                                                         ORDER BY COUNT(*) 
                                                         DESC LIMIT 5");
                        if(mysqli_num_rows($resultGroup)<1){
                            echo "<p> Aucun groupe trouvé </p>";
                        }else{
                            while($donnee = mysqli_fetch_array($resultGroup)){
                                echo '<div class="group" id='.$donnee['idGroup'].'>';
                                echo '    <p class="group-groupName">'.$donnee['nameGroup'].'</p>';
                                echo '    <p class="group-groupDate"> Créée le : '.$donnee['dateGroup'].'</p>';
                                // requete pour avoir le nombre de membres du groupe
                                $resultNbMembers = mysqli_query($co,"SELECT DISTINCT m.idUser
                                                                     FROM memberlist m 
                                                                     WHERE m.idGroup = ".$donnee['idGroup']." 
                                                                     GROUP BY m.idUser");
                                echo '<p class="group-groupMember">'.mysqli_num_rows($resultNbMembers).' membres</p>';
                                echo '    <hr style="background-color: rgb(44, 80, 97);margin-top: 2px;margin-bottom: 4px;"/>';
                                echo '    <p class="group-groupDesc">'.$donnee['descGroup'].'</p>';
                                echo '</div>';
                                //echo '<li>'.$donnee['idGroup']." - ";
                            }
                        }


                    ?>
                
            </div>
            <div class="col-sm-6">
                <form action="../controleurs/control_userCreation.php" method="POST" >

                    <h3 class="group-titleh3" style="font-size: 170%;">Formulaire d'inscription</h3>
                    <hr class="group-hr"/>

                    <h3 class="group-titleh3">Nom</h3>
                    <hr class="group-hr"/> 
                    <input type="text" name="name" class="form-control" id="exampleInputName1" aria-describedby="emailHelp" placeholder="Nom..." required>

                    <h3 class="group-titleh3">Prénom</h3>
                    <hr class="group-hr"/> 
                    <input type="text" name = "firstname" class="form-control" id="exampleInputFirstname1" aria-describedby="emailHelp" placeholder="Prénom..." required>

                    <h3 class="group-titleh3">Login</h3>
                    <hr class="group-hr"/> 
                    <input type="text" name="login" class="form-control" id="exampleInputLogin1" aria-describedby="emailHelp" placeholder="Login..."required>


                    <h3 class="group-titleh3">Adresse e-mail</h3>
                    <hr class="group-hr"/> 
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email..." required>

                    <h3 class="group-titleh3">Mot de passe</h3>
                    <hr class="group-hr"/> 
                    <input type="password" name="password" class="form-control" id="exampleInputPwd1" aria-describedby="emailHelp" placeholder="Mot de passe..." required>

                    

                    <input type="submit" class="form-control" value="S'inscrire" style="margin-top: 10px;"/>

                    <!--
                        <div class="form-group">
                            <label for="inputCivil1">Civilité</label>
                            <select id="inputCivil1" name="genre" class="form-control">
                            <option selected>Choose...</option>
                            <option>Homme</option>
                            <option>Femme</option>
                            </select>
                        </div>
                    -->
                </form>
                
            </div>
            
        </div>
    </div>

    
        

</body>
</html>

<style>

    h2{color: #696969;}
    body{background-color: #DCDCDC; }


    @media screen and (max-width: 1280px)
    {
        h2
        {
            font-size: 100px;
        }

    }

    

</style>

