<?php
	require_once("../modeles/Utilisateur.php");
	require_once("../modeles/Bd.php");

    session_start();
    if(!isset($_SESSION['logged'])){header("Location: ./connexion.php");}

?>

<!DOCTYPE html>
<html>
<head>

	<title>G4V - Messages</title>
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
        </div>
</div>

<?php
    include('./footer.php');
?>

</body>
</html>
<style>
.container-fluid{
    min-height: 600px;
    height: auto;
}

</style>