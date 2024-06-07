    $(document).ready(function(){
    $(document).on('click','a[data-role=update_register]',function(){
        var id = $(this).data('id');
        var date = $('#'+id+'date_rm').text();
        var heure = $('#'+id+'heure_rm').text();
        var bl = $('#'+id+'bl_rm').text();
        var sac = $('#'+id+'sac_rm').text();
        var camion = $('#'+id+'camion_rm').text();
        var transport = $('#'+id+'transporteur_rm').text();
        var chauffeur = $('#'+id+'chauffeur_rm').text();
        var id_camion = $('#'+id+'id_camion_rm').text();
        var id_chauffeur = $('#'+id+'id_chauffeur_rm').text();
        var id_declaration = $('#'+id+'id_declaration_rm').text();
        var declaration = $('#'+id+'declaration_rm').text();
        var cale = $('#'+id+'cale_rm').text();
        var id_cale = $('#'+id+'id_cale_rm').text();
        var dis_bl = $('#'+id+'dis_bl_rm').text();
        var poids_sac = $('#'+id+'poids_sac_rm').text();
        var id_produit = $('#'+id+'id_produit_rm').text();
        var id_destination = $('#'+id+'id_destination_rm').text();
        var id_navire = $('#'+id+'id_navire_rm').text();
        var poids = $('#'+id+'poids_rm').text();
        var sac_cale = $('#'+id+'sac_cale_rm').text();
         var sac_reconditionne = $('#'+id+'sac_reconditionne_rm').text();
         var id_detail = $('#'+id+'id_detail_rm').text();
         var statut = $('#'+id+'statut_rm').text();
         var destinataire = $('#'+id+'destinataire_rm').text();
          var des_douane = $('#'+id+'des_douane_rm').text();
           var client = $('#'+id+'id_client_rm').text();
/*
           var existingOption = $('#declaration_m_rm option[value="' + id_declaration + '"]');
if (existingOption.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOption.text(declaration);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_declaration,
      text: declaration
   });
   $('#declaration_m_rm').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
} */

/*
var existingOptioncale = $('#cale_m_rm option[value="' + id_cale + '"]');
if (existingOptioncale.length > 0) {
   // Mettre à jour le texte de l'option existante
   existingOptioncale.text(cale);
} else {
   // Ajouter une nouvelle option avec la valeur et le texte correspondants
   var newOption = $('<option>', {
      value: id_cale,
      text: cale
   });
   $('#cale_m_rm').prepend(newOption);
   // Sélectionner l'option par défaut
   newOption.prop('selected', true);
} */

        $('#cale_m_rm').val(id_cale);
        $('#declaration_m_rm').val(id_declaration);
        $('#date_m_rm').val(date);
        $('#heure_m_rm').val(heure);
        $('#bl_m_rm').val(bl);
        $('#sac_m_rm').val(sac);
        $('#myInput_m_rm').val(camion);
        $('#myInputTransp_m_rm').val(transport);
        $('#myInputc_m_rm').val(chauffeur);
        $('#val_input2_m_rm').val(id_camion);
        $('#val_input2c_m_rm').val(id_chauffeur);
        $('#dis_bl_m_rm').val(dis_bl);
        $('#poids_sac_m_rm').val(poids_sac);
        $('#id_produit_m_rm').val(id_produit);
        $('#id_destination_m_rm').val(id_destination);
        $('#id_navire_m_rm').val(id_navire);
        $('#poids_m_rm').val(poids);
        $('#statut_m_rm').val(statut);
        $('#sac_cale_m_rm').val(sac_cale);
        $('#sac_reconditionne_m_rm').val(sac_reconditionne);
        $('#id_detail_m_rm').val(id_detail);
        $('#destinataire_m_rm').val(destinataire);
        $('#id_client_m_rm').val(client);

        if(sac_cale!=''){
            $('#les_inputs_detail_chargement_m_rm').css('display','table');
        }
        else{
            $('#les_inputs_detail_chargement_m_rm').css('display','none');
        }

        if(des_douane=='LIVRAISON'){
            $('#div_destinataire').css('display','table');
        }
        else{
            $('#div_destinataire').css('display','none');
        }

        if(poids_sac==0){
            $('#sac_modif_visible').css('display','none');
        }
        else{
           $('#sac_modif_visible').css('display','table');
        }




        $('#id_m_rm').val(id);


        
        $('#modif_register').modal('toggle');
    });
    
    $(document).on('click','a[data-role=mod]',function(){
        var date = $('#date_m_rm').val();
        date=date.replace(' ','');
        var heure = $('#heure_m_rm').val();
        var declaration = $('#declaration_m_rm').val();
        var id_cale = $('#cale_m_rm').val();
        var camion = $('#val_input2_m_rm').val();
        var chauffeur = $('#val_input2c_m_rm').val();
        var bl = $('#bl_m_rm').val();
        var sac = $('#sac_m_rm').val();
        sac=sac.replace(' ','');
        var dis_bl = $('#dis_bl_m_rm').val();
        var poids_sac = $('#poids_sac_m_rm').val();
         var id_produit =$('#id_produit_m_rm').val();
        var id_destination= $('#id_destination_m_rm').val();
        var id_navire= $('#id_navire_m_rm').val();
        var poids= $('#poids_m_rm').val();
        var type=$('#id_navire_m_rm').val();
        var statut=$('#statut_m_rm').val();
        var sac_reconditionne= $('#sac_reconditionne_m_rm').val();
        var sac_cale= $('#sac_cale_m_rm').val();
        var id_detail=$('#id_detail_m_rm').val();
        var destinataire=$('#destinataire_m_rm').val();
         var client=$('#id_client_m_rm').val();
            var id = $('#id_m_rm').val();
        $('#frontend').css('display', 'none');

        
        $.ajax({
        url:'ajax/crud/modifier_bl.php',
        method:'post',
        data:{date:date,heure:heure,declaration:declaration,id_cale:id_cale,camion:camion,chauffeur:chauffeur,bl:bl,id:id,dis_bl:dis_bl,sac:sac,poids_sac:poids_sac,id_produit:id_produit,id_destination:id_destination,id_navire:id_navire,type:type,poids:poids,statut:statut,sac_cale:sac_cale,sac_reconditionne:sac_reconditionne,id_detail:id_detail,destinataire:destinataire,client:client},
        success: function(response){
            $('#TableSain').html(response);

        $('#modif_register').modal('toggle');
        }
    });
    });


});