$(document).ready(function(){
    $(document).on('change','select[data-role=goNavire_situation]',function(){
  //$('#type').css('display', 'block');

    var navire = $('#navire_situation').val();
 

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
        url:'ajax/choix_navire_situation.php',
        method:'post',
        data:{navire:navire},
        success: function(response){
            $('#date_situation').html(response);
           
     
       
        }
    });


 

  });
});