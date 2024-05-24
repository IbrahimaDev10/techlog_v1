<?php
require('../database.php');

if(empty($_SESSION['id'])){
  header('location:../index.php');
}
require('controller/acces_transfert.php');
//header("Cache-Control: no-cache, must-revalidate");
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

echo $_SESSION['id'];
               

/*$naviress=$bdd->prepare("select dis.*, mg.*,nav.* from dispatching as dis 
                 inner join mangasin as mg on dis.id_mangasin=mg.id
                 
                 inner join navire_deb as nav on dis.id_navire=nav.id
                 inner join simar_user as user on user.id_sim_user=mg.id_mangasinier
                 where mg.id_mangasinier=? group by nav.navire");
      $naviress->bindParam(1,$_SESSION['id']);
      $naviress->execute(); */






?>  



<!DOCTYPE html>
<html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
   


  <title>TRANSFRT</title>

  <!-- Bootstrap CSS-->
    
  <link rel="stylesheet" href="../assets/modules/bootstrap-5.1.3/css/bootstrap.css">
  <!-- Style CSS -->
  <link rel="stylesheet" href="../transfert/css/style.css">
 
   <link rel="stylesheet" href="../assets/css/repAccueil.css">
  <!-- FontAwesome CSS-->
  <link rel="stylesheet" href="../assets/modules/fontawesome6.1.1/css/all.css">
  <!-- Boxicons CSS-->
  <link rel="stylesheet" href="../assets/modules/boxicons/css/boxicons.min.css">
  <!-- Apexcharts  CSS -->
  <link rel="stylesheet" href="../assets/modules/apexcharts/apexcharts.css">
    <link rel="shortcut icon" type="image/png" href="../assets/images/mylogo.ico"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="btn.css">


</head>
<body >
  <input type="text" name="" id='session' <?php if(!empty($_SESSION['prod'])){ ?> value="<?php echo $_SESSION['prod'] ?>" <?php  } else{ ?> value="" <?php   } ?>  >
  <input type="text" name="" id='session_navire' <?php if(!empty($_SESSION['navire'])){ ?> value="<?php echo $_SESSION['navire'] ?>" <?php  } else{ ?> value="" <?php   } ?>  >
  <div id='session_de_page'> 
<style type="text/css">
  
.lienforme{
color:white; font-size: 20px; border: solid; background-color: black; margin-bottom: 50px;

}

 *{
  font-family: Times New Roman;
 } 

   .modal-header{
      
     /* background-image: url("images/simar2.jpg");
      background-repeat: no-repeat;
      background-size: 100%;
      background: #1B2B65;*/
       background: linear-gradient(to bottom, blue, #1B2B65);
       background: linear-gradient(to top, blue, #1B2B65);
       background: linear-gradient(to left, blue, #1B2B65);
      
      border-bottom-left-radius: 35%;
      border-bottom-right-radius: 35%;
      border: solid;
      border-color: rgb(145,145,255);
      border-width: 8px;
    }
    
  .modal-header{
      
     /* background-image: url("images/simar2.jpg");
      background-repeat: no-repeat;
      background-size: 100%;
      background: #1B2B65;*/
       background: linear-gradient(to bottom, blue, #1B2B65);
       background: linear-gradient(to top, blue, #1B2B65);
       background: linear-gradient(to left, blue, #1B2B65);
      
      border-bottom-left-radius: 35%;
      border-bottom-right-radius: 35%;
      border: solid;
      border-color: rgb(145,145,255);
      border-width: 8px;
      height: 150px;
    }

    .fabtn1{
  border: none;
   margin-right: 3px;
  color:rgb(0,141,202);
  text-align: center;


 }
 .btn1{
  background: linear-gradient(to bottom, blue, #1B2B65); background: linear-gradient(to left, blue, #1B2B65); background: linear-gradient(to top, blue, #1B2B65);
  text-align: center;

 }
    
 .logoo{

      border-radius: 50px;
       height: 120px;
        width: 200px;
        float: right;
        z-index: 2;
        text-align: center;

    }
    #perreur{
        color:red;
        font-weight: bold;
    }
        #p_erreur{
        color:black;
        font-weight: bold;

    }
    .err{
        width: 500px;
        
        background: white;
        vertical-align: middle;
        border: solid;
        border-color: black;
    }
    @keyframes clignoter {
            0% { opacity: 1; }
            50% { opacity: 0; }
            100% { opacity: 1; }
        }


        .ers{
        width: 500px;
       /* height: 300px; */
        background: white;
        vertical-align: middle;
       
    }
    #alerte_excedent{
        width: 500px;
       /* height: 300px; */
        
        vertical-align: middle;
        animation: clignoter 1s infinite;
        color:red !important;
        font-weight: bold;
    }
    #close_erreur{
        font-size: 30px;
    }
    .fa-truck{
 float: left;
  font-size: 18px;
color: white;
vertical-align: middle;
display: flex; 
margin-right: 5px;
}
.colaffiches{
  font-size: 14px;
  text-align: center;
  vertical-align: center;
}
#mangasinOption{
  color: red;

}
#lesInfos{
  color: yellow;

}
#lesInfos2{
  color: black;

}
#soustotal{
  color: white;
}
.sain{
  background: yellow;
}
#EnteteRecapStockDep{
  background: black;
  color: white;
  text-align: center;
  vertical-align: middle;
  font-size: 12px;
}
.celrecap{
  text-align: center !important;
  vertical-align: middle !important;
}
.titre_recap{
  
  width: 100%;
  font-size: 20px;

 
}
#div_recap{
  background: white;
 
 
  border: solid;
  border-color: blue;
/*  border-bottom-right-radius: 30%;
  border-bottom-left-radius: 30%; */
 /* border-radius: 80%; */
 margin-bottom: 10px;
}
#RecapStockDep{
  background: blue;
  color: white;
  text-align: center;
  vertical-align: middle;
  font-size: 16px;
}
   

@media (max-width: 1200px){
.tr_data_attente_avaries{
 font-size:10px;
}
}

#th_table_rec{
      background: linear-gradient(to bottom, blue, rgb(0,141,202));
       text-align: center; 
        color: white;
         font-weight: bold;
         font-size:12px;
         vertical-align: middle;

    }
    .tr_data_sain{
  text-align: center;
    vertical-align: middle;
    font-size: 14px !important;
}
.LesOperations{
  background:rgb(0,162,232);
  border: solid;
  border-radius: 40px;
 margin-left: 0;
 margin-right: 0;
 width: 100%;

}
.TitreOperation{
  color: white !important;
}
</style>



  
  <!--Topbar -->
  <div class="topbar transition">
  <div class="bars">
    <button type="button" class="btn transition" id="sidebar-toggle">
      <i class="fa fa-bars"></i>
    </button>
  </div>
    <div class="menu">
      <ul>
        
       
          <li class="nav-item dropdown">
          <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../assets/images/avatar/avatar-1.png" alt="">
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="my-profile.html"><i class="fa fa-user size-icon-1"></i> <span>My Profile</span></a>
            <a class="dropdown-item" href="settings.html"><i class="fa fa-cog size-icon-1"></i> <span>Settings</span></a>
            <hr class="dropdown-divider">
            <a class="dropdown-item" href="#"><i class="fa fa-sign-out-alt  size-icon-1"></i> <span>My Profile</span></a>
          </ul>
          </li>
      </ul>
    </div>
  </div>

  <!--Sidebar-->
  <div class="sidebar transition overlay-scrollbars animate__animated  animate__slideInLeft">
        <div class="sidebar-content"> 
          <div id="sidebar">
      
      <!-- Logo -->
      <div class="logo">
          <h2 class="mb-4"><img style="width: 150px; height: 150px;" src="../assets/images/mylogo.ico"> </h2>
      </div>

            <ul class="side-menu">
                <li>
          <a href="../star_superviseur.php" class="active">
            <i class='bx bxs-dashboard icon' ></i> MENU PRINCIPAL
          </a>
                 <?php include('../reception/page.php'); ?>
        </li>

        <!-- Divider-->
                <li class="divider" style="font-size: 18px;" data-text="STARTER"> LIVRAISON</li>

                <li>
                    <a href="#">
                        <i class='bx bx-columns icon' ></i> 
                        GESTION DES RELACHES
                        <i class='bx bx-chevron-right icon-right' ></i>
                    </a>
                    <ul class="side-dropdown">
                       
                        
                                                
                    </ul>
                </li>

                       <li> <a style="font-size:12px;"  data-bs-toggle="modal" data-bs-target="#situation_24h">
                        <i class='bx bx-columns icon'  ></i>GESTION DES BONS D'ENLEVEMENT 
                       </a>
                    
                   </li>

                    <li> <a style="font-size:12px;" href="pv_reception.php?id=<?php echo $_GET['id']; ?>">
                        <i class='bx bx-columns icon'  ></i>RECONDITIONNEMENT
                       </a>
                    
                   </li>
                   

                    <li><a   href="situation_de_reception.php?id=<?php echo $_GET['id']; ?>"> <i class='bx bx-columns icon' ></i> MES SITUATIONS</a></li>
                     <li><a   href="reconditionnement.php?id=<?php echo $_SESSION['id']; ?>"> <i class='bx bx-columns icon' ></i> PV DE LIVRAISON</a></li>
                    </a>
                    
                       

 
 


        
               

        <!-- Divider-->
       </div> 
   </div>
  </div><!-- End Sidebar-->


  <div class="sidebar-overlay"></div>


  <!--Content Start-->
  <div class="content-start transition">
    <div class="container-fluid dashboard">
      <div class="content-header">











  
    
  
 

<div class="container-fluid1 " id="situation"  style=" background: rgb(0,141,202);" >
        <div class="row">
            
            
                <div class="col-lg-12 col-md-12">
                    <h1 class="hem2" > TRANSFERT</h1><br>

                    
                    <form method="POST" >
                      <?php $a=$_SESSION['id']; ?>
                        <select  id="navires" class="mysel" style="margin-right: 3%; height: 30px;   width: 30%;"  data-role='navire'>
                            <option value="">selectionner un navire</option>
                            <?php $naviress=choix_du_navire_transfert($bdd,$a);
                            while ($row=$naviress->fetch()) {
                             ?>
                                <option value=<?php echo $row['id_navire'].'-'.$a; ?> >  <?php echo $row['navire'] ?> </option>
                            <?php } ?>

                 </select>

                
                        
                     <select id="produit" class="mysel" name="produit" style=" height: 30px;  width: 30%; float: right;" data-role='produit'>
                            <option  value="">selectionner le produit</option>
                        </select>
                        
                 
                            
                    </form>
                
            </div>
        </div>
    </div>



  </div>
  



    <br><br>
    <div class="sit" id="sit">
    </div>

     <div id="main">
    </div>
        <div id="pv">
    </div>
            <div id="pv_recond">
    </div>

    <div id="situation_bon">
    </div>
        <div id="situation_relache">
    </div>

           <div id="situation_transit">
    </div>





  <!-- Footer -->       
  <footer>
    <div class="footer">
      <div class="float-start">
        <p>2023 &copy; Ibradev</p>
      </div>
        <div class="float-end">
          <p>Created with 
            <span class="text-danger">
              <i class="fa fa-heart"></i> by 
              <a href="https://www.facebook.com/andreew.co.id/" class="author-footer">Ibradev</a>
            </span> 
          </p>
      </div>
    </div>
  </footer>


  <!-- Preloader -->
  <div class="loader">
    <div class="spinner-border text-light" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
  
  <!-- Loader -->
  <div class="loader-overlay"></div>

  <!-- fin session_page !-->
</div>

  <!-- General JS Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../assets/js/atrana.js"></script>

  <!-- JS Libraies -->
  <script src="../assets/modules/jquery/jquery.min.js"></script>

  <script src="../assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/modules/popper/popper.min.js"></script>

  <!-- Chart Js -->
  <script src="../assets/modules/apexcharts/apexcharts.js"></script>
  <script src="../assets/js/ui-apexcharts.js"></script>

    <!-- Template JS File -->
  <script src="../assets/js/script.js"></script>
  <script src="../assets/js/custom.js"></script>
  <script src="livraison.js"></script>
   
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>





  <script type="text/javascript">
    $(document).ready(function(){
    $(document).on('change','select[data-role=navire]',function(){

       var navire = $('#navires').val();

        $.ajax({
    url:'choix_navire.php',
    method:'post',
    data:{navire:navire},
    success: function(response){
       
      $('#produit').html(response);
   
    
    }
  });
    });
});


  </script>


  <script type="text/javascript">
    $(document).ready(function(){
    $(document).on('change','select[data-role=produit]',function(){

       var produit = $('#produit').val();

        $.ajax({
    url:'choix_produit.php',
    method:'post',
    data:{produit:produit},
    success: function(response){
       
      $('#main').html(response);
   
    
    }
  });
    });
});


  </script>

   <script type="text/javascript">
    $(document).ready(function(){
    $(document).on('click','button[data-role=visibleSain]',function(){

       $('#TableSain').css('display','block');

    });
});


  </script>

   <script type="text/javascript">
    $(document).ready(function(){
    $(document).on('click','a[data-role=affiche_formulaire_reond_liv]',function(){
        //var id_dis = $(this).data('id');
       //var nav = $(this).data('navire');
       //var nav = $(this).data('navire');
       var declaration = $(this).data('declaration');
        //var date = $('#'+id+'date').text();
   
        
       // var date = $('#date_sit_rep').val();
         //var flasque = $('#flasque_sit').val();
         //var mouille = $('#mouille_sit').val();

         //$('#id_dis_rec').val(id_dis);
         //$('#id_navire_rec').val(nav);
         $('#id_declaration_recond').val(declaration);
         //var id_dis = $('#id_dis_rec').val();


         
        
$('#form_reconditionnement').modal('toggle');


      $(document).ready(function(){
    $(document).on('click','a[data-role=ajout_recond]',function(){
                
        var date = $('#date_recond').val();
        var sac_eventres = $('#sac_eventres').val();
        var sacf = $('#sac_recond').val();
       // date=date.replace(' ','');
        var sac_bal = $('#sac_balayure').val();
        var poids_bal = $('#poids_balayure').val();
       
        var id_dis= $('#id_dis_recond').val();
       var navire= $('#navire_recond').val();
        var produit= $('#id_produit_recond').val();
        var poids_sac= $('#poids_sac_recond').val();
        var destination= $('#id_destination_recond').val();
         var declaration= $('#id_declaration_recond').val();

        

        
        $.ajax({
    url:'insert_recond_liv.php',
    method:'post',
    data:{date:date,sac_bal:sac_bal,poids_bal:poids_bal,poids_sac:poids_sac,id_dis:id_dis,navire:navire,produit:produit,destination:destination,sacf:sacf,sac_eventres:sac_eventres,declaration:declaration},
    success: function(response){
      $('#TableRecond').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
    //$('#modif_dec').modal('toggle');*/
    $('#form_reconditionnement').modal('toggle');
    }
  });
    });
});

});
});
</script>

 

 <script type="text/javascript"> 
      function filtreca() {
        var search = document.getElementById('myInput').value;
        var camionList = document.getElementById('camionList');
        camionList.style.display="block";
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../transfert/action.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            camionList.innerHTML = xhr.responseText;
          }
        };
        xhr.send('query=' + search);
      }

       function stockerIds(element) {
    var camionId = element.id;
    var input2 = document.getElementById("val_input2");
    input2.value = camionId;

   /* var camionText = element.innerText;
    var input = document.getElementById("myInput");
    input.value = camionText;
    var div = document.getElementById("camionList");
    div.style.display = "none"; */
    var camtext = document.getElementById("n_camions"+camionId);
    var camionText = camtext.innerText;
    var input = document.getElementById("myInput");
    input.value = camtext.innerText;
    var div = document.getElementById("camionList");
    div.style.display = "none";

    var trtext = document.getElementById("transp"+camionId);
     var transpText = trtext.innerText;
    var input3 = document.getElementById("myInputTransp");
    input3.value = transpText;
     

    
  }
    </script>


 <script type="text/javascript"> 
      function filtreChau() {
        var search = document.getElementById('myInputc').value;
        var camionList = document.getElementById('camionListc');
        camionList.style.display="block";
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../transfert/action_chauffeur.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            camionList.innerHTML = xhr.responseText;
          }
        };
        xhr.send('query=' + search);
      }

        function stockerIdc(element) {
    var camionId = element.id;
    var input2 = document.getElementById("val_input2c");
    input2.value = camionId;

    var camionText = element.innerText;
    var input = document.getElementById("myInputc");
    input.value = camionText;
    var div = document.getElementById("camionListc");
    div.style.display = "none";

  input2.value = chauffeurId;

    
  }
    </script>


<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-roles=afficher_form_tr_sain]',function(){
      var produit= $(this).data('produit');
      var poids_sac= $(this).data('poids_sac');
      var navire= $(this).data('navire');
      var destination= $(this).data('destination');

      $('#form_tr_sain').modal('toggle');
   /*   $('#ajout_m').css('display','none');
       $('#ajout_s').css('display','block');
       $('#ajout_bal').css('display','none'); */
       $('#ajout_s').css('display','none');
      $('#ajout_m').css('display','table');


          var statut='sain';
          $('#statut').val(statut);
      

    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-roles=afficher_formulaire_liv_flasque]',function(){
      var produit= $(this).data('produit');
      var poids_sac= $(this).data('poids_sac');
      var navire= $(this).data('navire');
      var destination= $(this).data('destination');
      $('#form_tr_sain').modal('toggle');
   /*   $('#ajout_m').css('display','none');
       $('#ajout_s').css('display','block');
       $('#ajout_bal').css('display','none'); */
       $('#ajout_s').css('display','none');
    
      $('#ajout_m').css('display','table');
      

             var statut='flasque';
          $('#statut').val(statut);
      

    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-roles=afficher_formulaire_liv_mouille]',function(){
      var produit= $(this).data('produit');
      var poids_sac= $(this).data('poids_sac');
      var navire= $(this).data('navire');
      var destination= $(this).data('destination');
      $('#form_tr_sain').modal('toggle');
   /*   $('#ajout_m').css('display','none');
       $('#ajout_s').css('display','block');
       $('#ajout_bal').css('display','none'); */
       $('#ajout_s').css('display','none');
      $('#ajout_m').css('display','table');
     
     
          var statut='mouille';
          $('#statut').val(statut);
    });
  });
</script>


<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','a[data-roles=afficher_formulaire_liv_balayure]',function(){
      var produit= $(this).data('produit');
      var poids_sac= $(this).data('poids_sac');
      var navire= $(this).data('navire');
      var destination= $(this).data('destination');

      $('#form_tr_sain').modal('toggle');
   /*   $('#ajout_m').css('display','none');
       $('#ajout_s').css('display','block');
       $('#ajout_bal').css('display','none'); */
       $('#ajout_s').css('display','none');
      $('#ajout_m').css('display','table');


          var statut='balayure';
          $('#statut').val(statut);
      

    });
  });
</script>



<script type="text/javascript">
   $(document).ready(function(){
    $(document).on('click','a[data-role=ajout_liv]',function(){
      var date = $('#date_liv').val();
       var heure= $('#heure_liv').val();
        var sac = $('#sac_liv').val();
         var dec = $('#dec_liv').val();
         var poids_sac = $('#poids_sac_liv').val();
         var produit = $('#id_produit_tr').val();
         var navire = $('#id_navire_tr').val();
         var destination = $('#id_destination_tr').val();
          var camion = $('#val_input2').val();
          var chauffeur = $('#val_input2c').val();

        /*
        var bl_fournisseur = $('#bl_fournisseur').val();
         var camion = $('#camion_liv').val();
          var chauf = $('#chauf_liv').val();
           var permis = $('#permis_liv').val();
            var tel = $('#tel_liv').val();
            
              var rel = $('#rel_liv').val();
              
                var id_produit = $('#id_produit_liv').val();
                 
                  var id_dis = $('#id_dis_liv').val();
                   var navire = $('#id_navire_liv').val(); 
                   var destination = $('#id_destination_liv').val(); 
                   var destination_livraison = $('#destination_livraison').val(); 
                   var bl_simar = $('#bl_simar').val(); */
                   $('#form_tr_sain').modal('toggle');


                    $.ajax({
                      url:'insertion_transfert_sain.php',
                       method:'post',
                        data:{date:date,heure:heure,sac:sac,dec:dec,poids_sac:poids_sac,camion:camion,chauffeur:chauffeur,produit:produit,navire:navire,destination:destination/*bl_fournisseur:bl_fournisseur,camion:camion,chauf:chauf,permis: permis,tel:tel,rel:rel,id_produit:id_produit,navire:navire,id_dis:id_dis,destination:destination,destination_livraison:destination_livraison,bl_simar:bl_simar*/},
                         success: function(response){

                        $('#TableLivraison').html(response);
                       
                     }
                   });
                });
             });

</script>


<script type="text/javascript">
   $(document).ready(function(){
    $(document).on('click','a[data-role=ajout_liv_mouille]',function(){
      var date = $('#date_liv').val();
       var heure= $('#heure_liv').val();
        var sac = $('#sac_liv').val();
         var dec = $('#dec_liv').val();
         var poids_sac = $('#poids_sac_liv').val();
         var produit = $('#id_produit_tr').val();
         var navire = $('#id_navire_tr').val();
         var destination = $('#id_destination_tr').val();
          var camion = $('#val_input2').val();
          var chauffeur = $('#val_input2c').val();
          var statut = $('#statut').val();
          var etat_reception = $('#etat_reception').val();

        /*
        var bl_fournisseur = $('#bl_fournisseur').val();
         var camion = $('#camion_liv').val();
          var chauf = $('#chauf_liv').val();
           var permis = $('#permis_liv').val();
            var tel = $('#tel_liv').val();
            
              var rel = $('#rel_liv').val();
              
                var id_produit = $('#id_produit_liv').val();
                 
                  var id_dis = $('#id_dis_liv').val();
                   var navire = $('#id_navire_liv').val(); 
                   var destination = $('#id_destination_liv').val(); 
                   var destination_livraison = $('#destination_livraison').val(); 
                   var bl_simar = $('#bl_simar').val(); */
                   $('#form_tr_sain').modal('toggle');


                    $.ajax({
                      url:'insertion_transfert_avaries.php',
                       method:'post',
                        data:{date:date,heure:heure,sac:sac,dec:dec,poids_sac:poids_sac,camion:camion,chauffeur:chauffeur,produit:produit,navire:navire,destination:destination,statut:statut,etat_reception:etat_reception/*bl_fournisseur:bl_fournisseur,camion:camion,chauf:chauf,permis: permis,tel:tel,rel:rel,id_produit:id_produit,navire:navire,id_dis:id_dis,destination:destination,destination_livraison:destination_livraison,bl_simar:bl_simar*/},
                         success: function(response){
                if(statut=='mouille'){
                        $('#TableMouille').html(response);
                        }
                        else if(statut=='flasque'){
                        $('#TableFlasque').html(response);
                        }
                        else if(statut=='sain'){
                        $('#TableLivraison').html(response);
                        }
                         else {
                        $('#TableBalayure').html(response);
                        }

                       
                     }
                   });
                });
             });

</script>










<script type="text/javascript">
   function visibleSain() {
    var sain = document.getElementById("TableLivraison");
     var flasque = document.getElementById("TableFlasque");
    var mouille = document.getElementById("TableMouille");
    var balayure = document.getElementById("TableBalayure");
  /*
     
      var relaches = document.getElementById("situation_relache");
      var bons = document.getElementById("situation_bon");
      var transits = document.getElementById("situation_transit");
       var pv_recond = document.getElementById("pv_recond"); */

    /*var relache = document.getElementById("TableRelache");
     var declaration = document.getElementById("TableDeclaration");
    
    var avaries = document.getElementById("TableAvaries");
     var recond = document.getElementById("TableRecond");
      var enleve = document.getElementById("TableEnleve");
      
       var pv = document.getElementById("pv");
       */
   
      sain.style.display = "table";
      flasque.style.display = "none";
    mouille.style.display = "none";
    balayure.style.display = "none";
    /*
       
       relaches.style.display = "none";
       bons.style.display = "none";
       transits.style.display = "none";
       pv_recond.style.display = "none"; * /
    /*  relache.style.display = "none";
      declaration.style.display = "none";
     
      avaries.style.display = "none";
      recond.style.display = "none";
      enleve.style.display = "none";
       
       pv.style.display = "none";
       */

    
  }
</script>

<script type="text/javascript">
   function visibleFlasque() {
    var sain = document.getElementById("TableLivraison");
     var flasque = document.getElementById("TableFlasque");
    var mouille = document.getElementById("TableMouille");
    var balayure = document.getElementById("TableBalayure");
  /*
     
      var relaches = document.getElementById("situation_relache");
      var bons = document.getElementById("situation_bon");
      var transits = document.getElementById("situation_transit");
       var pv_recond = document.getElementById("pv_recond"); */

    /*var relache = document.getElementById("TableRelache");
     var declaration = document.getElementById("TableDeclaration");
    
    var avaries = document.getElementById("TableAvaries");
     var recond = document.getElementById("TableRecond");
      var enleve = document.getElementById("TableEnleve");
      
       var pv = document.getElementById("pv");
       */
   
      sain.style.display = "none";
      flasque.style.display = "table";
      mouille.style.display = "none";
      balayure.style.display = "none";
    /*   mouille.style.display = "none";
       
       relaches.style.display = "none";
       bons.style.display = "none";
       transits.style.display = "none";
       pv_recond.style.display = "none"; * /
    /*  relache.style.display = "none";
      declaration.style.display = "none";
     
      avaries.style.display = "none";
      recond.style.display = "none";
      enleve.style.display = "none";
       
       pv.style.display = "none";
       */

    
  }
</script>

<script type="text/javascript">
   function visibleMouille() {
    var sain = document.getElementById("TableLivraison");
     var flasque = document.getElementById("TableFlasque");
   var mouille = document.getElementById("TableMouille");
    var balayure = document.getElementById("TableBalayure");
   /*
    
      var relaches = document.getElementById("situation_relache");
      var bons = document.getElementById("situation_bon");
      var transits = document.getElementById("situation_transit");
       var pv_recond = document.getElementById("pv_recond"); */

    /*var relache = document.getElementById("TableRelache");
     var declaration = document.getElementById("TableDeclaration");
    
    var avaries = document.getElementById("TableAvaries");
     var recond = document.getElementById("TableRecond");
      var enleve = document.getElementById("TableEnleve");
      
       var pv = document.getElementById("pv");
       */
   
      sain.style.display = "none";
      flasque.style.display = "none";
       mouille.style.display = "table";
       balayure.style.display = "none";
    /*
       
       relaches.style.display = "none";
       bons.style.display = "none";
       transits.style.display = "none";
       pv_recond.style.display = "none"; * /
    /*  relache.style.display = "none";
      declaration.style.display = "none";
     
      avaries.style.display = "none";
      recond.style.display = "none";
      enleve.style.display = "none";
       
       pv.style.display = "none";
       */

    
  }
</script>


<script type="text/javascript">
   function visibleBalayure() {
    var sain = document.getElementById("TableLivraison");
     var flasque = document.getElementById("TableFlasque");
   var mouille = document.getElementById("TableMouille");
  
     var balayure = document.getElementById("TableBalayure");
      /*
      var relaches = document.getElementById("situation_relache");
      var bons = document.getElementById("situation_bon");
      var transits = document.getElementById("situation_transit");
       var pv_recond = document.getElementById("pv_recond"); */

    /*var relache = document.getElementById("TableRelache");
     var declaration = document.getElementById("TableDeclaration");
    
    var avaries = document.getElementById("TableAvaries");
     var recond = document.getElementById("TableRecond");
      var enleve = document.getElementById("TableEnleve");
      
       var pv = document.getElementById("pv");
       */
   
      sain.style.display = "none";
      flasque.style.display = "none";
       mouille.style.display = "none";
       balayure.style.display = "table";
    /*
       
       relaches.style.display = "none";
       bons.style.display = "none";
       transits.style.display = "none";
       pv_recond.style.display = "none"; * /
    /*  relache.style.display = "none";
      declaration.style.display = "none";
     
      avaries.style.display = "none";
      recond.style.display = "none";
      enleve.style.display = "none";
       
       pv.style.display = "none";
       */

    
  }
</script>

 <script type="text/javascript">
    $(document).ready(function() {
        // Fonction pour copier la valeur de session à produit
        function Session() {
            var val_session = $('#session').val(); // Obtenir la valeur de l'élément avec l'ID 'session'
            var val_produit = $('#produit').val(); // Sélectionner l'élément avec l'ID 'produit'

            // Assurez-vous que val_session n'est pas vide avant de copier sa valeur
            if (val_session !='') {
             // val_session.value(2);
              $('#produit').val(val_session);
                //val_produit.val(val_session); // Copier la valeur de val_session à val_produit
            }
        }

        // Appeler la fonction Session lorsque le document est prêt
       // Session();
    });
</script>

 <script type="text/javascript">
    $(document).ready(function() {
        // Fonction pour copier la valeur de session à produit
        function Session_navire() {
            var produit = $('#session').val(); // Obtenir la valeur de l'élément avec l'ID 'session'
            var val_navire = $('#navires').val();
            var val_produit = $('#produit').val();
             // Sélectionner l'élément avec l'ID 'produit'

            // Assurez-vous que val_session n'est pas vide avant de copier sa valeur
            if (produit !='' && val_navire=='' ) {

               $.ajax({
                      url:'choix_produit.php',
                       method:'post',
                        data:{produit:produit},
                         success: function(response){

                        $('#main').html(response);
                       
                     }
                });
            }
        }

        // Appeler la fonction Session_navire lorsque le document est prêt
      // A SUIVRE  Session_navire();
    });
        
</script>
 </body>
</html>
