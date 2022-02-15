<footer class="contenufooter">

<link rel="stylesheet" type="text/css" href="../public/css/footer.css">


		<h3>Groups<span>4</span>Votes</h3>

			<div class="footer-gauche">
			   <div class="footer-about-title">	
					A propos
			   </div>
			   <div class="footer-about-content">	
					Site développé dans le cadre d'un projet informatique de deuxième année de DUT Informatique
			   </div>

			   
			</div>

			<div class="footer-centre">
				<div>
					<i class="fa fa-map-marker"></i>
					<p><span> Plateau de Moulon, Rue Noetzlin</span> 91400, Orsay</p>
				</div>

				<div>
					<i class="fa fa-phone"></i>
					<p>01 69 33 60 00</p>
				</div>

				<div>
					<i class="fa fa-envelope"></i>
					<p><a href="mailto:fitness++@info.com">projetwebs3@gmail.com</a></p>
				</div>

			</div>
	
			<div class="footer-droit">
				<p1 class="footer-apropos">
				<span>Informations</span>
					Il s'agit d'un site tout juste réalisé, en cas de problème, de bug, n'hésité pas à nous contacter <a href="./help">ici</a>.
				</p1>
				<br><br>
				<?php
		if(isset($_SESSION['logged'])){
				echo '<a class="logged" href="../controleurs/kill_session.php"><i class="fas fa-sign-out-alt"></i> Deconnexion</a><br><br>';
				echo '<a class="logged" href="/vues/parametre.php" class="header_navbar--menu-link"><i class="fas fa-cog"></i>  Preference</a>';
			echo '</div>';
		}
		else {
				echo '<a class="logged"  href="../vues/connexion.php"><i class="fas fa-sign-in-alt"></i> Connexion</a>';
			echo '</div>';
		}
			?>
			</div>

</footer>
			<div class="footer">
				<p class="footer-nom">Fait par Jérémy DUFOURMANTELLE &copy; 2019</p>
			</div>