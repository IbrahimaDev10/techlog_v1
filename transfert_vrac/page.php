
                    <ul class="side-dropdown">


                       <li><a href="../star_superviseur.php" >ACCUEIL</a></li>
                       <?php if($_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Admin"){ ?>
						<li><a href="../super/gestion_donnees.php" >GESTION DE DONNEES</a></li>
						<?php } ?>
						<li><a href="../super/debarquement.php" >DEBARQUEMENT</a></li>
						
						<?php if($_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Admin"){ ?>
						<li><a href="" >LIVRAISON</a></li>
						<li><a href="" >RECEPTION</a></li>
						<li><a href="" >ARCHIVES</a></li>
					<?php } ?>
						<li><a href="" >MESSAGERIE</a></li>
						<li><a href="" >FACTURATION</a></li>
						
						                        
                    </ul>
               
