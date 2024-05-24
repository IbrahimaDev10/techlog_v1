<?php 	
require('../database.php');
echo $_GET['id'];

$res4n= $bdd->prepare("SELECT   dis.*, rm.*, nav.*, tr.*    FROM register_manifeste as rm 
                 inner join dispatching as dis on rm.id_dis_bl=dis.id_dis
                 inner join navire_deb as nav on rm.id_navire=nav.id
                 inner join transit as tr on rm.id_declaration=tr.id_trans

                   WHERE rm.id_register_manif=?  ");
        $res4n->bindParam(1,$_GET['id']);
        $res4n->execute();

$camionsModif= $bdd->query("SELECT  *  FROM chauffeur 
                   ");



if (isset($_POST['modifier_register'])) {
    // code...
    if(!empty($_POST['navire']) and !empty($_POST['produit'])  /*and !empty($_POST['poids'])*/ and !empty($_POST['date'])    and !empty($_POST['cale']) and !empty($_POST['heure']) and !empty($_POST['declaration']) and !empty($_POST['numero_bl']) /* and !empty($_POST['camions']) and !empty($_POST['chauffeur'])  and !empty($_POST['permis']) and !empty($_POST['tel'])  and !empty($_POST['transport'])*/      and !empty($_POST['client'])  and !empty($_POST['destination'])  /*and !empty($_POST['sac'])*/   and !empty($_POST['destinataire']) and !empty($_POST['input2']) and !empty($_POST['input2'])  ){

        $nav=$_POST['navire'];
        $prod=$_POST['produit'];
        $poids=$_POST['poids']; 
        $date=$_POST['date'];
        $heure=$_POST['heure'];
        $declaration=$_POST['declaration'];
        
        $cale=$_POST['cale']; 
        $chauffeur=$_POST['chauffeur'];
        $camions=$_POST['camions'];
        $cam=explode(",", $chauffeur);
       // $permis=$_POST['permis'];
       // $tel=$_POST['tel'];
       // $transport=$_POST['transport'];
        $essai=9;
        $essai2=1;
         
        $bl=$_POST['numero_bl']; 
        $sac=$_POST['sac']; 
        $poids_net=$_POST['poids'];
        $client=$_POST['client'];
        $destination=$_POST['destination'];
        $camion=$_POST['input2'];
        $chauffeur=$_POST['input2c'];

         //$autre_destination=$_POST['autre_destination'];
         $type=$_POST['type'];
         $id_register_manif=$_POST['id_register'];

        $destinataire=$_POST['destinataire'];
 if ($type=="SACHERIE") {
     # code...
 
  $calPoids=$sac*$poids/1000; 
 
  }  
  if ($type=="VRAQUIER") {
     # code...
  $calPoids=$_POST['poids_s']; 
  
  }    

try{
 
     $insertRecep1= $bdd->prepare("UPDATE register_manifeste set dates=?, heure=?, cale=?, bl=?, camions=?, chauffeur=?,  id_dis_bl=?, id_declaration=?, sac=?, poids=?, id_produit=?, poids_sac=?, id_client=?, id_destination=?,id_navire=?, destinataire=? where id_register_manif=? "); 



$insertRecep1->bindParam(1,$date); 
$insertRecep1->bindParam(2,$heure);

$insertRecep1->bindParam(3,$cale);
$insertRecep1->bindParam(4,$bl);
$insertRecep1->bindParam(5,$camion);
$insertRecep1->bindParam(6,$chauffeur);

$insertRecep1->bindParam(7,$_POST['id_di']);


$insertRecep1->bindParam(8,$declaration);
$insertRecep1->bindParam(9,$sac);
$insertRecep1->bindParam(10,$calPoids);


$insertRecep1->bindParam(11,$prod);
$insertRecep1->bindParam(12,$poids);
$insertRecep1->bindParam(13,$client);
$insertRecep1->bindParam(14,$destination);
$insertRecep1->bindParam(15,$nav);


$insertRecep1->bindParam(16,$destinataire);
$insertRecep1->bindParam(17,$id_register_manif);

$insertRecep1->execute();

echo "INSERTION REUSSI ";
header('location:tr_manifest.php');
/*else{
    echo "erreurrrrrrrrrrrrrrr";
}*/
}
catch(PDOException $e){
    die('Erreur:' .$e->getMessage());
    
}

}
else{
  echo "VEUILLEZ REMPLIR TOUS LES CHAMPS "; 
 
}



 
 
 


    
    // arrêt du script pour éviter l'affichage de la page actuelle après la soumission du formulaire
    
}

 ?>
 <html lang="fr">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Debarquement</title>

	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="assets/modules/bootstrap-5.1.3/css/bootstrap.css">
	<!-- Style CSS -->
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/stylecell.css">
	<!-- FontAwesome CSS-->
	<link rel="stylesheet" href="assets/modules/fontawesome6.1.1/css/all.css">
	<!-- Boxicons CSS-->
	<link rel="stylesheet" href="assets/modules/boxicons/css/boxicons.min.css">
	<!-- Apexcharts  CSS -->
	<link rel="stylesheet" href="assets/modules/apexcharts/apexcharts.css">
    <link rel="shortcut icon" type="image/png" href="assets/images/mylogo.ico"/>
</head>
<body >


<style type="text/css">
	*{
		font-family: Times New Roman;
	}
	
</style>

<div class="" id="modifier" >
  <div class="modal-dialog" style="z-index: 1;">
  	<center>
    <div class="modal-content" style=" border: solid; border-color: blue;">
      <div class="modal-header bg-primary">
        <center>
        <h2 class="modal-title fs-5 text-white text-center"  style="text-align:center; ">MODIFICATION</h2></center>

        
      </div>

      <div class="modal-body" >
               <center>
            <img class="logo" src="assets/images/mylogo.ico" style="border-radius: 50px;">

        </center>
        <form method="POST" >

   <div class="mb-3">
    <?php while($rown=$res4n->fetch()){ ?>
   
    <input type="text" class="form-control"     name="id_register" id="id_register_manif" hidden="true" id="exampleFormControlInput1" value=<?php  
        echo $rown['id_register_manif'];
    ?> > 
  </div>
  <div class="mb-3">    
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="navire"  name="navire"  id="navire" hidden="true"  value=<?php  
        echo $rown['id_navire'];
    ?> > 
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="type"  name="type" hidden="true"  id="type"  value=<?php  
        echo $rown['type'];
    ?> > 

</div>

   <div class="mb-3">
     
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="produit" name="produit"  id="produit" hidden="true" value=<?php  
        echo $rown['id_produit'];
    ?> >
</div>

   <div class="mb-3">
     
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="id_dis" name="id_di"  id="produit" hidden="true" value=<?php   
        echo $rown['id_dis'];
    ?> >
</div>


   <div class="mb-3">
      
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="produit" name="poids"  id="poids" hidden="true" value=<?php  
        echo $rown['poids_kg'];
    ?> >
</div>

   <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">date</label><br> 
  <input  type="date"  class="form-control"  name="date" id="dates" id="exampleFormControlInput1" value="<?php echo $rown['dates'] ?>" style=" margin-bottom: 20px;">
</div>
  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">heure</label><br>
  <input type="time" class="form-control"   name="heure" id="exampleFormControlInput1" value=<?php  
        echo $rown['heure'];
    ?> >

</div> <br>

<div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">declaration</label><br>
    <select  name="declaration"  style="width: 30%;" id="exampleFormControlInput1">

    <option value=<?php  echo $rown['id_declaration'];?> > <?php  echo $rown['numero_declaration'];?></option>
    <?php $resdesModif= $bdd->prepare("SELECT trans.*, dis.*   FROM dispatching as dis 
                inner join transit as trans on dis.id_dis=trans.id_bl

                   WHERE dis.id_dis=? 
                   ");
        $resdesModif->bindParam(1,$rown['id_dis_bl']);
        $resdesModif->execute();

         while($dec=$resdesModif->fetch()){ ?> 
    <option value=<?php  echo $dec['id_trans']; ?> ><?php  echo $dec['numero_declaration']; ?></option>  
   <?php } ?>
    </select>
</div> <br>



   <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">cale</label><br>
  <select style="width: 30%; margin-bottom: 20px; " name="cale" id="exampleFormControlInput1">
    <option value=<?php   echo $rown['cale'];?>><?php  
        echo $rown['cale'];
    ?></option>

    <?php
             $rescaleModif= $bdd->prepare("SELECT  *   FROM dispatching 
               

                   WHERE id_dis=? 
                   ");
        $rescaleModif->bindParam(1,$rown['id_dis_bl']);
        $rescaleModif->execute();

     if($rown['type']=="SACHERIE"){ while($res=$rescaleModif->fetch()){ 
            $rescale2= $bdd->prepare("SELECT cales   FROM declaration_chargement
               

                   WHERE id_navire=? and id_produit=? and conditionnement=? 
                  ");
        $rescale2->bindParam(1,$res['id_navire']);
        $rescale2->bindParam(2,$res['id_produit']);
        $rescale2->bindParam(3,$res['poids_kg']);
        $rescale2->execute(); } 
    while($rownn=$rescale2->fetch()){ ?>
      <option value=<?php echo $rownn['cales']; ?>><?php echo $rownn['cales']; ?></option>
    <?php } }?>
     <?php
           
          $rescale= $bdd->prepare("SELECT  *   FROM dispatching 
               

                   WHERE id_dis=? 
                   ");
        $rescale->bindParam(1,$rown['id_dis_bl']);
        $rescale->execute();

      if($rown['type']=="VRAQUIER"){ while($res=$rescale->fetch()){ 
            $rescale2= $bdd->prepare("SELECT cales   FROM declaration_chargement
               

                   WHERE id_navire=? and id_produit=? 
                  ");
        $rescale2->bindParam(1,$res['id_navire']);
        $rescale2->bindParam(2,$res['id_produit']);
       
        $rescale2->execute(); } 
    while($rownn=$rescale2->fetch()){ ?>
      <option value=<?php echo $rownn['cales']; ?>><?php echo $rownn['cales']; ?></option>
    <?php } }?>
  </select>

</div>
<div style="background: blue">
   <div class="mb-3">
      <center>  
    <h3 style="background: white; color: blue;">TRANSPORT</h3>
   
 <label style="color: white;">CAMIONS  </label><br> 
  </center> 
  <?php $camion=$bdd->prepare('select c.*,tr.* from camions as c inner join transporteur as tr on c.id_trans=tr.id where id_camions=?');
    $camion->bindParam(1,$rown['camions']);
    $camion->execute();
    while($cam=$camion->fetch()){

   ?>
<input type="text" id="myInput"  placeholder="SAISIR LE N° DE CAMION" style="width: 15%; " onkeyup="filtreca();" value="<?php echo htmlspecialchars($cam['num_camions']); ?>" ><br><br>
<div id="camionList" style="background: white; display: none; " >
  </div>
<label style="color: white;">TRANSPORTEUR  </label><br> 
<input type="text" id="myInputTransp" placeholder="transporteur" style="width: 15%; " value="<?php echo htmlspecialchars($cam['nom'])  ?>" disabled="true" >


<div id="camionList" style="background: white; display: none; " >
  </div>
 



<input type="" name="input2" id="val_input2"   value="<?php echo $cam['id_camions']; ?>"  >
<?php } ?>
 <center> <br>  
<label style="color: white;">CHAUFFEUR  </label> 
</center> 
 <?php $chauffeurss=$bdd->prepare('select * from chauffeur where id_chauffeur=?');
    $chauffeurss->bindParam(1,$rown['chauffeur']);
    $chauffeurss->execute();
    while($cam=$chauffeurss->fetch()){

   ?>
<input type="text" id="myInputc"  placeholder="chauffeur" style="width: 30%;" onkeyup="filtreChau();" value="<?php echo $cam['nom_chauffeur']. ' permis: '.$cam['n_permis']. ' TEL: ' .$cam['num_telephone']; ?>" >

<div id="camionListc" style="background: white; display: none;" >
  

</div>
<input type="" name="input2c" id="val_input2c" value="<?php echo $cam['id_chauffeur']; ?>" >

  <?php } ?>
  </div>

  
</div>
 </div><br> 

<div class="mb-3">
    <label for="exampleFormControlInput1"  class="form-label">N° BL</label><br> 
    <input type="text" name="numero_bl" placeholder="numero bl" id="numero_bl"  id="exampleFormControlInput1" style="width: 15%;"  value=<?php  echo $rown['bl'];?>>
   <br>



</div><br>
   <div class="mb-3">
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="client"   hidden="true"  value=<?php  
        echo $rown['id_client'];
    ?> >
     <input type="text" class="form-control"  placeholder="" name="destination" hidden="true" value=<?php  
        echo $rown['id_destination'];
    ?> >

</div>

<?php if($rown['des_douane']=="LIVRAISON"){ ?>


 <div class="mb-3">
 
  <input style="width: 50%; margin-bottom: 20px;" type="text" class="form-control" id="exampleFormControlInput1" placeholder="destinataire" name="destinataire" value=<?php  echo $rown['destinataire'];?>  >
</div>
<?php 
}
 if($rown['des_douane']=="TRANSFERT"){   ?>
  <div class="mb-3">
 
  <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="destinataire" name="destinataire" value="AUCUN" hidden="true" >
</div>


<?php  

} ?>

  
<?php if($rown['type']=="SACHERIE" and $rown['poids_kg']!=0){ ?>
  <div class="mb-3">
      <label for="exampleFormControlInput1"  class="form-label">nombre sac</label>
  <input style="width: 15%; margin-bottom: 20px;" type="text"  class="form-control"  name="sac" id="sac" id="exampleFormControlInput1" value=<?php  echo $rown['sac'];?> >
  </div>
  <div class="mb-3" hidden="true">
      <label for="exampleFormControlInput1" id="exampleFormControlInput1" class="form-label">poids</label>
  <input style="width: 20%; margin-bottom: 20px;" type="text" class="form-control"  placeholder="poids" name="poids_s"  value="0" hidden="true" value=<?php  echo $rown['poids'];?>>
</div> <br> 

<?php } ?>

<?php  if($rown['type']=="VRAQUIER" and $rown['poids_kg']==0){ ?>
<div class="mb-3" hidden="true" >
      <label for="exampleFormControlInput1" class="form-label">nombre_sac</label><br>
  <input style="width: 15%; " type="text" class="form-control"  placeholder="0" value="0" name="sac" id="sac" hidden="true" value=<?php  echo $rown['sac'];?>>
</div><br>
<div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">poids</label><br>  
  <input style="width: 15%; " type="text" class="form-control" id="exampleFormControlInput1" placeholder="poids" name="poids_s" value=<?php  echo $rown['poids'];?> >

</div>

<?php } ?>
<?php  if($rown['type']=="VRAQUIER" and $rown['poids_kg']!=0){ ?>
<div class="mb-3" >
      <label for="exampleFormControlInput1" class="form-label">nombre_sac</label>
  <input style="width: 50%; margin-bottom: 20px;" type="text" class="form-control"   name="sac" value=<?php  echo $rown['sac'];?> >
</div>
<div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">poids</label>
  <input style="width: 50%; margin-bottom: 20px;" type="text" class="form-control"  placeholder="poids" name="poids_s" value=<?php  echo $rown['poids'];?>>

</div>

<?php } ?>

   
 <?php } ?>



   
      


  
   <div class="mb-3">


        

         <center>
        <button type="submit" class="btn btn-primary " style="text-align: center; background: blue; color:white; width: 30%;" name="modifier_register"  >enregistrer</button></center>

      </div> 
      </form>   
      <div class="modal-footer">
 
        
      </div>
    </div>
  </div>
  </center>
</div>
</div>



<script type="text/javascript"> 
      function filtreca() {
        var search = document.getElementById('myInput').value;
        var camionList = document.getElementById('camionList');
        camionList.style.display="block";
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'action.php', true);
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
        xhr.open('POST', 'action_chauffeur.php', true);
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



 <script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function camion3(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                     var   lec = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('chauf3').innerHTML = lec;
                     
                        // On se sert de innerHTML pour rajouter les options à la liste
                        

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectCamionsModif.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('cam3');
                idcam = sel.options[sel.selectedIndex].value;
                xhr.send("idCam="+idcam);
            }
        </script>  


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
