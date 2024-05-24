
                    <ul class="side-dropdown">

      <?php if($_SESSION['profil']=="Admin" or $_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Mangasinier" ){ ?>
                       <li><a href="../star_superviseur.php" >ACCUEIL</a></li>
                   <?php } ?>
                   <?php if($_SESSION['profil']=="Admin" or $_SESSION['profil']=="superviseur" ){ ?>
						<li><a href="gestion_donnees.php" >GESTION DE DONNEES</a></li>
					<?php } ?>
					<?php if($_SESSION['profil']=="Admin" or $_SESSION['profil']=="superviseur" ){ ?>
						<li><a href="debarquement.php" >DEBARQUEMENT</a></li>
					<?php } ?>
			<?php if($_SESSION['profil']=="Admin" or $_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Mangasinier" ){ ?>
						<li><a href="" >LIVRAISON</a></li>
					<?php } ?>
		<?php if($_SESSION['profil']=="Admin" or $_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Mangasinier" ){ ?>			
						<li><a href="../reception/rep_accueil.php?id=<?php echo $_SESSION['id']; ?>" >RECEPTION</a></li>
					<?php } ?>
					<?php if($_SESSION['profil']=="Admin" or $_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Mangasinier" ){ ?>
						<li><a href="" >MESSAGERIE</a></li>
					<?php } ?>
					<?php if($_SESSION['profil']=="Admin" or $_SESSION['profil']=="superviseur"  ){ ?>
						<li><a href="" >ARCHIVES</a></li>
					<?php } ?>
					<?php if($_SESSION['profil']=="Admin" or $_SESSION['profil']=="superviseur" or $_SESSION['profil']=="Mangasinier" ){ ?>
						<li><a href="" >FACTURATION</a></li>
					<?php } ?>
						
						                        
                    </ul>
               
