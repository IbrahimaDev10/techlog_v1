function heure_automatique(){
    var maintenant = new Date();
    var heures = maintenant.getHours();
  var minutes = maintenant.getMinutes();

  // Formater l'heure et les minutes pour qu'ils aient toujours deux chiffres (par exemple, 09:05)
  if (heures < 10) heures = "0" + heures;
  if (minutes < 10) minutes = "0" + minutes;

  // Combinez l'heure et les minutes dans le format HH:MM
  var heureActuelle = heures + ":" + minutes;

  // Définir la valeur par défaut du champ d'entrée sur l'heure actuelle
 // document.getElementById("heuresain").value = heureActuelle;
  $('#heuresain').val(heureActuelle);
  $('#myInput').val('');
  $('#myInputTransp').val('');
  $('#myInputc').val('');
   $('#val_input2c').val('');
   $('#val_input2').val('');
   $('#InputRemorque').val('');
   $('#val_input_remorque').val('');
   $('#sac_cale').val('');
   $('#sac_reconditionne').val('');
   $('#reste_detail').css('display','none');
   $('#les_inputs_detail_chargement').css('display','none');

  $('#enregistrement').modal('toggle');
  //document.getElementById("insertion_sain").click();
 var bl='2000';
 var navire=$('#input_navire').val();
 var produit=$('#input_produit').val();
 var poids_sac=$('#input_poids_sac').val();
 var destination=$('#input_destination').val();
 var client=$('#input_client').val();
 //var statut=$('#input_statut').val();
 var statut='sain';

 $("#poids_cacher").css('display','none');

 var des_douane=$('#input_des_douane').val();
 if(des_douane=='LIVRAISON'){
    $('#bon').css('display','block');
 }
 //$('.restant').css('background','red');
 
// $('#blsain').val(bl);
 //$('#num_du_bl').text('cjdnjndsj');
   $.ajax({
        url:'ajax/Infos_bl.php',
        method:'post',
        data:{navire:navire,produit:produit,poids_sac:poids_sac,destination:destination,statut:statut,client:client},
        success: function(response){
          $('#info_bl').html(response);
         // $('#detail_transporteur').modal('toggle');
            

           
     
       
        }
    });

    $.ajax({
        url:'ajax/update_select_declaration.php',
        method:'post',
        data:{navire:navire,produit:produit,poids_sac:poids_sac,destination:destination,statut:statut,client:client},
        success: function(response){
          $('#declarationsain').html(response);
         // $('#detail_transporteur').modal('toggle');
            

           
     
       
        }
    });

}