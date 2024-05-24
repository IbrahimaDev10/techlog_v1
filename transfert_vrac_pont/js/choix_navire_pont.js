$(document).ready(function(){
    $(document).on('change','select[data-role=goProduit_navire]',function(){
  //$('#type').css('display', 'block');

    var navire = $('#navire_pont_bascule').val();
 

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
        url:'ajax/choix_navire_pont.php',
        method:'post',
        data:{navire:navire},
        success: function(response){
            $('#produit_pont_bascule').html(response);
           
     
       
        }
    });


 

  });
});