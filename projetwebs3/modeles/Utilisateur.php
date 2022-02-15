<?php
abstract class Utilisateur {
protected $nom;
protected $prenom;
protected $poids;


abstract function insererBase($co);
abstract function getNum($co);
abstract function getType();

public function getNom(){
return $this->nom;
}
public function getPrenom(){
return $this->prenom;
}
public function getPoids(){
return $this->poids;
}

}

class UtilisateurActif extends Utilisateur {
private $login;
private $mdp;
private $mail;

public function __construct($nom,$prenom,$login,$mdp,$mail){
$this->nom = $nom;
$this->prenom = $prenom;
$this->login = $login;
$this->mdp = $mdp;
$this->mail = $mail;

}

public function insererBase($co){
mysqli_query($co,"INSERT INTO utilisateur(nomUtilisateur, prenomUtilisateur, login, mdpUtilisateur, emailUtilisateur) VALUES('$this->nom','$this->prenom','$this->login','$this->mdp','$this->mail')");
}

public function getNum($co){
$num = mysqli_query($co,"SELECT idUtilisateur FROM utilisateur WHERE login='$this->login'");
$ligne = mysqli_fetch_assoc($num);
return $ligne['idUtilisateur'];
}


public function getMail(){
return $this->mail;
}
public function getmdp(){
return $this->mdp;
}
public function getlogin(){
return $this->login;
}

public function getType(){
return 1;
}



}


?>