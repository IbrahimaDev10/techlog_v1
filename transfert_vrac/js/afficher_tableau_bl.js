$(document).ready(function(){
    $(document).on('change','select[data-role=goProduit]',function(){
  //$('#type').css('display', 'block');

    var idProduit = $('#produit').val();
    var explode = idProduit.split('-');
    var  produit=explode[0];
      var poids_sac=explode[1];
      var navire=explode[2];
      var destination=explode[3];
      var id_dis=explode[4];
      var type=explode[5];
      var client=explode[6];


    var transfert_sain = $('#transfert_sain').val();
    var transfert_des_avaries = $('#transfert_des_avaries').val();
    var avaries_de_deb = $('#avaries_de_deb').val();
  //   var valsatut=$('#input_statut_new').val();
     var statut='sain';
    $("#btn_pre_debarquement").css({
  'background': 'yellow',
  'color': 'blue'
});

/* if(poids_sac!=0){
      $('#poids_cacher').css('display','none');
      
    }
           else{

      $('#poids_cacher').css('display','block');
    } */

/* dddddd
      if(poids_sac!=0){
      $('#poids_cacher').css('display','none');
       $('#sac_cacher').css('display','block');
    }
           if(poids_sac==0){
      $('#sac_cacher').css('display','none');
      $('#poids_cacher').css('display','block');
    }
    */

        


   /*     if(transfert_sain==0){
          $('#input_statut').val('yess');
     
      
    } */

      //var type_dec = $('#type_dec').val();


        $.ajax({
       /* url:'recuperer_statut_avaries', */
        url:'ajax/afficher_tableau_bl.php',
        method:'post',
        data:{produit:produit,navire:navire,poids_sac:poids_sac,destination:destination,transfert_sain:transfert_sain,transfert_des_avaries:transfert_des_avaries,avaries_de_deb:avaries_de_deb,statut:statut,client:client},
        success: function(response){
            $('#main').html(response);
           
     
       
        }
    });


 

  });
});


