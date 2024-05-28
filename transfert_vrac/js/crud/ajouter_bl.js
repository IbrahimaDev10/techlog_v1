    $(document).ready(function(){
    $(document).on('click','a[data-role=btn_register]',function(){
        
   // Mettre à jour le texte de l'option existante
  

        
        
  
        var dates = $('#datesain').val();
        //date=date.replace(' ','');
        var heure = $('#heuresain').val();
        var navire = $('#naviresain').val();
        var type = $('#typesain').val();
        var bl = $('#blsain').val();
        var poids_sac = $('#poids_sacssain').val();
        var declaration = $('#declarationsain').val();
        var cale = $('#calesain').val();
        var id_dis = $('#id_dissain').val();
        var client = $('#clientsain').val();
        var mangasin = $('#mangasinsain').val();
        var destinataire = $('#destinatairesain').val();
        var val_input2 = $('#val_input2').val();
        var val_input2c = $('#val_input2c').val();
        var val_input_remorque = $('#val_input_remorque').val();
        var sac = $('#sacsain').val();
        var poids = $('#poidssain').val();
        var id_produit = $('#produitsain').val();
        var statut='sain';
        //var statut=$('#input_statut').val();
         var transfert_sain=$('#transfert_sain').val();
         var sac_cale=$('#sac_cale').val();
         var sac_reconditionne=$('#sac_reconditionne').val();
         var des_douane=$('#input_des_douane').val();
       //  $('#avaries_debarquement').css('display','none');

           


         
if( (type=='SACHERIE' && des_douane=='TRANSFERT' && statut=='sain' && cale!='' && sac!='' && dates!='' && heure!='' && bl!='' && declaration!='' 
    && val_input2!='' && val_input2c!='')
|| (type=='SACHERIE' && des_douane=='TRANSFERT' &&  statut=='mouille' && cale!='' && sac!='' 
    && dates!='' && heure!='' && bl!='' && declaration!='' && val_input2!='' && val_input2c!='') 
|| (type=='SACHERIE' && des_douane=='TRANSFERT' &&  statut=='flasque' && cale!='' && sac!='' && poids!='' && dates!='' && heure!='' && bl!='' && declaration!='' && val_input2!='' && val_input2c!='') 
|| (type=='VRAQUIER' && poids_sac!=0 && cale!='' && sac!='' && dates!='' && heure!='' && bl!='' && declaration!='' && val_input2!='' && val_input2c!='')
|| (type=='VRAQUIER' && poids_sac==0 && cale!=''  && dates!='' && heure!='' && bl!='' && declaration!='' && val_input2!='' && val_input2c!='') ){
                
        $('#enregistrement').modal('toggle');

  
        
        $.ajax({
        url:'ajax/crud/ajouter_bl.php',
        method:'post',
        data:{dates:dates,heure:heure,navire:navire,type:type,poids_sac:poids_sac,declaration:declaration,client:client,mangasin:mangasin,destinataire:destinataire,val_input2:val_input2,val_input2c:val_input2c,sac:sac,poids:poids,cale:cale,id_dis:id_dis,bl:bl,id_produit:id_produit,statut:statut,transfert_sain:transfert_sain,val_input_remorque:val_input_remorque,sac_cale:sac_cale,sac_reconditionne:sac_reconditionne,des_douane:des_douane},
        success: function(response){
            $('#TableSain').html(response);
            descendre_dernier_enregistrement();

        
        }
    });

        } //condition des types navire et des_douane
        else{
           Swal.fire({
        icon: 'error',
        title: 'Erreur',
        text: 'Veuillez remplir tous les champs obligatoires.',
        confirmButtonText: 'OK'
    }); 
        }
         //condition des vides


       /*        
            if(type=='VRAQUIER' && poids_sac!=0 && cale!='' && sac!='' && dates!='' && heure!='' && bl!='' && declaration!='' && val_input2!='' && val_input2c!='' ){
                
        $('#enregistrement').modal('toggle');

  
        
        $.ajax({
        url:'ajouttablesain.php',
        method:'post',
        data:{dates:dates,heure:heure,navire:navire,type:type,poids_sac:poids_sac,declaration:declaration,client:client,mangasin:mangasin,destinataire:destinataire,val_input2:val_input2,val_input2c:val_input2c,sac:sac,poids:poids,cale:cale,id_dis:id_dis,bl:bl,id_produit:id_produit,statut:statut,transfert_sain:transfert_sain,val_input_remorque:val_input_remorque,des_douane:des_douane},
        success: function(response){
            $('#TableSain').html(response);
            descendre_dernier_enregistrement();

        
        }
    });

        } //condition des types navire et des_douane
        else{
           Swal.fire({
        icon: 'error',
        title: 'Erreur',
        text: 'Veuillez remplir tous les champs obligatoires.',
        confirmButtonText: 'OK'
    }); 
        } */
         
    });


});