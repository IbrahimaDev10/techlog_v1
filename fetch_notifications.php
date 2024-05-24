<?php
require('database.php');
$notification=$bdd->prepare("SELECT * from notification where user_destinataire=? ");
$notification->bindParam(1,$_SESSION['id']);
$notification->execute();

$nbre_notification=$bdd->prepare("SELECT count(message) from notification where status_lecture=0 and user_destinataire=? ");
$nbre_notification->bindParam(1,$_SESSION['id']);
$nbre_notification->execute(); ?>


 <div class="menu" style="margin-right: 100px;" id="notifications-container">
      <ul>
        <li class="nav-item dropdown dropdown-list-toggle">
          <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             <i class="fa fa-bell size-icon-1"></i><span class="badge bg-danger notif"><?php  if($nbre_notif=$nbre_notification->fetch()){ echo $nbre_notif['count(message)']; }  ?></span>
          </a>         
          <div class="dropdown-menu dropdown-list" >
            <div class="dropdown-header">Notifications</div>
            <div class="dropdown-list-content dropdown-list-icons">
              <div class="custome-list-notif">
              <?php while($notif=$notification->fetch()){  ?> 
              <a href="#" class="dropdown-item dropdown-item-unread">
                <div class="dropdown-item-icon bg-primary text-white">
                  <i class="fas fa-code"></i>
                </div>
                <div class="dropdown-item-desc">
                  <?php echo $notif['message'];  ?>
                  <div class="time text-primary"> il y'a 3 Minutes</div>
                </div>
                </a>
              <?php   } ?>

                

            
          </li>
       
          <li class="nav-item dropdown" >
          <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="assets/images/avatar/avatar-1.png" alt="">
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="my-profile.html"><i class="fa fa-user size-icon-1"></i> <span>MON PROFIL</span></a>
            <a class="dropdown-item" href="settings.html"><i class="fa fa-cog size-icon-1"></i> <span>PARAMETRES</span></a>
            <hr class="dropdown-divider">
            <a class="dropdown-item" href="logout"><i class="fa fa-logout  size-icon-1"></i> <span>DECONNEXION</span></a>
          </ul>
          </li>
      </ul>
    </div>