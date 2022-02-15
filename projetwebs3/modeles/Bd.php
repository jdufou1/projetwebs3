<?php
	class Bd{
		private $host;
		private $user;
		private $bdd;
		private $passwd;
		
		public function __construct(){
			$this->host = "mysql-projetwebs3.alwaysdata.net";
			$this->user = "195124";
			$this->bdd = "projetwebs3_database";
			$this->passwd = "jyde-7819020";
		}
		
		public function ouvrirConnexion(){
			$co = mysqli_connect($this->host , $this->user , $this->passwd, $this->bdd);
			return $co;
		}
		
		
		public function fermerConnexion($co){			
			mysqli_close($co);
		}
		
	}
?>
