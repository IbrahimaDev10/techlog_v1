
//POUR LA FERMETURE DES DIV ERREURS APRES L'AFFICHAGE DU MESSAGE D'ERREUR
    $(document).ready(function(){
    $(document).on('click','a[data-role=fermer]',function(){
        $('#LesErreurs').css('display', 'none');
    });
    
    
});


 
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
            function goNavireSit(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('client').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectNavire.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('navires');
                idnavire = sel.options[sel.selectedIndex].value;
                xhr.send("idNavire="+idnavire);
            }



               
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function goNavireSit_tr(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('client_tr').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectNavire_tr.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('navires_tr');
                idnavire = sel.options[sel.selectedIndex].value;
                xhr.send("idNavire="+idnavire);
            }        
       

       
 
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function goClient(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        lecale = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('produit').innerHTML = lecale;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectClient.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('client');
                idclient = sel.options[sel.selectedIndex].value;
                xhr.send("idClient="+idclient);
            }
       




        
     
 
           
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function goProduit(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        lecales = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('main').innerHTML = lecales;


                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","selectTableLivraison.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur

                sel = document.getElementById('produit');
                idproduit = sel.options[sel.selectedIndex].value;
                xhr.send("idProduit="+idproduit);
            }
          



  
  




  function visibleRelache() {
    var sain = document.getElementById("TableLivraison");
    var relache = document.getElementById("TableRelache");
     var declaration = document.getElementById("TableDeclaration");
    var mouille = document.getElementById("TableMouille");
    var avaries = document.getElementById("TableAvaries");
     var recond = document.getElementById("TableRecond");
      var enleve = document.getElementById("TableEnleve");
       var balayure = document.getElementById("TableBalayure");
       var pv = document.getElementById("pv");
         var pv_recond = document.getElementById("pv_recond");
   
      relache.style.display = "table";
      sain.style.display = "none";
      declaration.style.display = "none";
      mouille.style.display = "none";
      avaries.style.display = "none";
      recond.style.display = "none";
      enleve.style.display = "none";
       balayure.style.display = "none";
       pv_recond.style.display = "none";
       pv.style.display = "none";

    
  }


  function visibleDeclaration() {
    var sain = document.getElementById("TableLivraison");
    var relache = document.getElementById("TableRelache");
    var declaration = document.getElementById("TableDeclaration");
    var mouille = document.getElementById("TableMouille");
    var avaries = document.getElementById("TableAvaries");
     var recond = document.getElementById("TableRecond");
     var enleve = document.getElementById("TableEnleve");
      var balayure = document.getElementById("TableBalayure");
       var pv = document.getElementById("pv");
        var pv_recond = document.getElementById("pv_recond");
       

   
      declaration.style.display = "table";
      sain.style.display = "none";
      relache.style.display = "none";
      mouille.style.display = "none";
      avaries.style.display = "none";
      recond.style.display = "none";
      enleve.style.display = "none";
       balayure.style.display = "none";
        pv.style.display = "none";
       pv_recond.style.display = "none";

    
  }


 



  function visibleAvaries() {
    var avaries = document.getElementById("TableAvaries");
    var sain = document.getElementById("TableLivraison");
    var relache = document.getElementById("TableRelache");
     var declaration = document.getElementById("TableDeclaration");
     var mouille = document.getElementById("TableMouille");
      var recond = document.getElementById("TableRecond");
       var enleve = document.getElementById("TableEnleve");
        var balayure = document.getElementById("TableBalayure");
        var pv = document.getElementById("pv");
          var pv_recond = document.getElementById("pv_recond");

      avaries.style.display = "table";
      mouille.style.display = "none";
      sain.style.display = "none";
      relache.style.display = "none";
      declaration.style.display = "none";
      recond.style.display = "none";
      enleve.style.display = "none";
       balayure.style.display = "none";
       pv_recond.style.display = "none";
       pv.style.display = "none";
    
  }

  function visibleRecond() {
    var recond = document.getElementById("TableRecond");
    var sain = document.getElementById("TableLivraison");
    var relache = document.getElementById("TableRelache");
     var declaration = document.getElementById("TableDeclaration");
    var mouille = document.getElementById("TableMouille");
    var avaries = document.getElementById("TableAvaries");
     var enleve = document.getElementById("TableEnleve");
      var balayure = document.getElementById("TableBalayure");
      var pv = document.getElementById("pv");
        var pv_recond = document.getElementById("pv_recond");

      recond.style.display = "table";
      sain.style.display = "none";
      relache.style.display = "none";
      declaration.style.display = "none";
      mouille.style.display = "none";
      avaries.style.display = "none";
      enleve.style.display = "none";
       balayure.style.display = "none";
       pv_recond.style.display = "none";
       pv.style.display = "none";

    
  }

  function visibleEnleve() {
    var enleve = document.getElementById("TableEnleve");
    var recond = document.getElementById("TableRecond");
    var sain = document.getElementById("TableLivraison");
    var relache = document.getElementById("TableRelache");
     var declaration = document.getElementById("TableDeclaration");
    var mouille = document.getElementById("TableMouille");
    var avaries = document.getElementById("TableAvaries");
     var balayure = document.getElementById("TableBalayure");
     var pv = document.getElementById("pv");
       var pv_recond = document.getElementById("pv_recond");
      
      enleve.style.display = "table";
      recond.style.display = "none";
      sain.style.display = "none";
      relache.style.display = "none";
      declaration.style.display = "none";
      mouille.style.display = "none";
      avaries.style.display = "none";
       balayure.style.display = "none";
       pv_recond.style.display = "none";
       pv.style.display = "none";

    
  }




  $(document).ready(function(){
    $(document).on('click','a[data-role=ajout_relache]',function(){
      
         
        var date = $('#date_rel').val();
       var poids= $('#poids_rel').val();
        var num = $('#num_rel').val();
         var banque = $('#banque_rel').val();
        var navire = $('#id_navire_rel').val();
        var id_dis = $('#id_dis_rel').val();


        
        $.ajax({
    url:'insertion_relache.php',
    method:'post',
    data:{date:date,poids:poids,num:num,navire:navire,id_dis:id_dis,banque:banque},
    success: function(response){
      $('#TableRelache').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
    //$('#modif_dec').modal('toggle');*/
    $('#form_relache').modal('toggle');
    }
  });
    });
});




  $(document).ready(function(){
    $(document).on('click','a[data-role=ajout_bon_enlevement]',function(){
      
         
        var date = $('#date_enleve').val();
       var poids= $('#poids_enleve').val();
        var num = $('#num_enleve').val();
       
        var navire = $('#id_navire_enleve').val();
        var id_dis = $('#id_dis_enleve').val();


        
        $.ajax({
    url:'insertion_bon_enlevement.php',
    method:'post',
    data:{date:date,poids:poids,num:num,navire:navire,id_dis:id_dis},
    success: function(response){
      $('#TableEnleve').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
    //$('#modif_dec').modal('toggle');*/
    $('#form_Enleve').modal('toggle');
    }
  });
    });
});




  $(document).ready(function(){
    $(document).on('click','a[data-role=ajout_dec]',function(){
      
         
        var date = $('#date_dec').val();
       var poids= $('#poids_dec').val();
        var num = $('#num_dec').val();
        var navire = $('#id_navire_dec').val();
        var id_dis = $('#id_dis_dec').val();


        
        $.ajax({
    url:'insertion_declaration.php',
    method:'post',
    data:{date:date,poids:poids,num:num,navire:navire,id_dis:id_dis},
    success: function(response){
      $('#TableDeclaration').html(response);
      /*$('#'+id).children('td[data-target=cales]').text(cale);
    $('#'+id).children('td[data-target=nom_chargeur]').text(ch);
    $('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
    //$('#modif_dec').modal('toggle');*/
    $('#form_declaration').modal('toggle');
    }
  });
    });
});







  $(document).ready(function(){
    $(document).on('click','a[data-role=ajout_liv_mouille]',function(){
      var date = $('#date_liv').val();
       var heure= $('#heure_liv').val();
        var bl_fournisseur = $('#bl_fournisseur').val();
         var camion = $('#camion_liv').val();
          var chauf = $('#chauf_liv').val();
           var permis = $('#permis_liv').val();
            var tel = $('#tel_liv').val();
             var dec = $('#dec_liv').val();
              var rel = $('#rel_liv').val();
               var sac = $('#sac_liv').val();
                var produit = $('#id_produit_liv').val();
                 var poids_sac = $('#poids_sac_liv').val();
                  var id_dis = $('#id_dis_liv').val();
                   var navire = $('#id_navire_liv').val(); 
                    var destination = $('#id_destination_liv').val();
                    $.ajax({
                      url:'insertion_livraison_mouille.php',
                       method:'post',
                        data:{date:date,heure:heure,bl_fournisseur:bl_fournisseur,camion:camion,chauf:chauf,permis: permis,tel:tel,dec:dec,rel:rel,sac:sac,produit:produit,poids_sac:poids_sac,navire:navire,id_dis:id_dis,destination:destination},
                         success: function(response){

                        $('#TableMouille').html(response);
                       $('#form_livraison').modal('toggle');
                     }
                   });
                });
             });


   $(document).ready(function(){
    $(document).on('click','a[data-role=ajout_bal]',function(){
      var date = $('#date_liv').val();
       var heure= $('#heure_liv').val();
        var bl_fournisseur = $('#bl_fournisseur').val();
         var camion = $('#camion_liv').val();
          var chauf = $('#chauf_liv').val();
           var permis = $('#permis_liv').val();
            var tel = $('#tel_liv').val();
             var dec = $('#dec_liv').val();
              var rel = $('#rel_liv').val();
               var sac = $('#sac_liv').val();
                var id_produit = $('#id_produit_liv').val();
                 var poids_sac = $('#poids_sac_liv').val();
                  var id_dis = $('#id_dis_liv').val();
                   var navire = $('#id_navire_liv').val(); 
                   var destination = $('#id_destination_liv').val(); 
                    $.ajax({
                      url:'insertion_livraison_balayure.php',
                       method:'post',
                        data:{date:date,heure:heure,bl_fournisseur:bl_fournisseur,camion:camion,chauf:chauf,permis: permis,tel:tel,dec:dec,rel:rel,sac:sac,id_produit:id_produit,poids_sac:poids_sac,navire:navire,id_dis:id_dis,destination:destination},
                         success: function(response){

                        $('#TableBalayure').html(response);
                       $('#form_livraison').modal('toggle');
                     }
                   });
                });
             });



  $(document).ready(function(){
    $(document).on('click','a[data-role=update_livraison_sain]',function(){
    /*  var date = $('#date_liv').val();
       var heure= $('#heure_liv').val();
        var bl_fournisseur = $('#bl_fournisseur').val();
         var camion = $('#camion_liv').val();
          var chauf = $('#chauf_liv').val();
           var permis = $('#permis_liv').val();
            var tel = $('#tel_liv').val();
             var dec = $('#dec_liv').val();
              var rel = $('#rel_liv').val();
               var sac = $('#sac_liv').val();
                var id_produit = $('#id_produit_liv').val();
                 var poids_sac = $('#poids_sac_liv').val();
                  var id_dis = $('#id_dis_liv').val();
                   var navire = $('#id_navire_liv').val(); */ 
                   $('#form_update_livraison_sain').modal('toggle');
                    $.ajax({
                      url:'insertion_livraison_sain.php',
                       method:'post',
                        data:{/*date:date,heure:heure,bl_fournisseur:bl_fournisseur,camion:camion,chauf:chauf,permis: permis,tel:tel,dec:dec,rel:rel,sac:sac,id_produit:id_produit,poids_sac:poids_sac,navire:navire,id_dis:id_dis*/},
                         success: function(response){

                        $('#TableLivraison').html(response);
                      // $('#form_livraison').modal('toggle');
                     }
                   });
                });
             });




  $(document).ready(function(){
    $(document).on('click','a[data-role=ajout_liv_mouilles]',function(){
      var date = $('#date_mo').val();
       var heure= $('#heure_mo').val();
        var bl_fournisseur = $('#bl_fournisseur_mo').val();
         var camion = $('#camion_mo').val();
          var chauf = $('#chauf_mo').val();
           var permis = $('#permis_mo').val();
            var tel = $('#tel_mo').val();
             var dec = $('#dec_mo').val();
              var rel = $('#rel_mo').val();
               var sac = $('#sac_mo').val();
                var id_produit = $('#id_produit_mo').val();
                 var poids_sac = $('#poids_sac_mo').val();
                  var id_dis = $('#id_dis_mo').val();
                   var navire = $('#id_navire_mo').val(); 
                   var destination = $('#id_destination_liv').val();
                    $.ajax({
                      url:'insertion_livraison_mouille.php',
                       method:'post',
                        data:{date:date,heure:heure,bl_fournisseur:bl_fournisseur,camion:camion,chauf:chauf,permis: permis,tel:tel,dec:dec,rel:rel,sac:sac,id_produit:id_produit,poids_sac:poids_sac,navire:navire,id_dis:id_dis,destination:destination},
                         success: function(response){
                        $('#TableMouille').html(response);
                       $('#form_livraison_mouille').modal('toggle');
                     }
                   });
                });
             });




 






//FERMERVIDES
    $(document).ready(function(){
    $(document).on('click','a[data-role=fermerVIDES]',function(){
        $('#VIDES').css('display', 'none');
        $('#alerte_excedent').css('display', 'none');
    });
    
    
});


