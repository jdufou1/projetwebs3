<?php

    require_once("../modeles/Utilisateur.php");
    require_once("../modeles/Bd.php");
    require_once("./mail.php");

    session_start();
    if(!isset($_SESSION['logged'])){header("Location: ./connexion.php");}

    // Récupération des données

    $idGroupe = $_POST['idGroupe'];
    $shortDesc = $_POST['shortDesc'];
    $longDesc = $_POST['longDesc'];

    if(isset($_POST['categories'])){$categories = explode(",",$_POST['categories']);}
    $deadline = $_POST['date'];
    $vote = $_POST['vote'];
    $imgpath = $_POST["imgpath"];


    echo ' photo : '.$imgpath.'    ';
    echo $idGroupe;
    echo $shortDesc;
    echo $longDesc;
    echo $categories[0];
    //echo $date;
    echo $vote;

    // Traitement

    $bd = new Bd();
    $co = $bd->ouvrirConnexion();

    $voteValue = 0; // n'est pas un vote
    if($vote == "true"){$voteValue = 1;}
    $date = date("Y-m-d");

    echo $voteValue;



    //1
    $proposition = "INSERT INTO PROPOSITION(shortDescProposition,longDescProposition,dateProposition,photoProposition,vote,deadline)
    VALUES('".$shortDesc."','".$longDesc."','".$date."','".$imgpath."',".$voteValue.",'".$deadline."')";

    $request1 = mysqli_query($co,$proposition);

    echo $proposition;
    //2 - On récupére l'id de la proposition que l'on vient de créer
    $idPropositionReq = "SELECT idProposition FROM PROPOSITION WHERE shortDescProposition ='".$shortDesc."' AND longDescProposition ='".$longDesc."'";

    $request2 = mysqli_query($co,$idPropositionReq);
    $idProposition = 0;
    while($donnee = mysqli_fetch_array($request2)){ $idProposition = $donnee['idProposition'];}

    $memberList = "INSERT INTO memberlist(idUser,idGroup,idProposition)
    VALUES(".$_SESSION['idUser'].",".$idGroupe.",".$idProposition.")";

    echo $memberList;

    $request3 = mysqli_query($co,$memberList);

    
    //3 - on insére les catégories liés à cette proposition
    if(isset($_POST['categories'])){
        foreach ($categories as $value) {
            $typeCategories = explode("-",$value);
            //0 - id, 1 - checked, 2 - type
            if($typeCategories[1] != "false"){
                $request4 = "INSERT INTO categoryList(idCategory,idProposition,categoryLevel)VALUES(".$typeCategories[0].",".$idProposition.",'".$typeCategories[2]."')";
                $request4 = mysqli_query($co,$request4);
                echo $request4;
            }
        }
    }
    

    

?>
