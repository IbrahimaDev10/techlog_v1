        $(document).ready(function(){
    $(document).on('change','select[data-role=goDateSit]',function(){
  //$('#type').css('display', 'block');

    var idDate = $('#date').val();
    var deb_client = $('#deb_client').val();
    var deb_cale = $('#deb_cale').val();
    var deb_sain = $('#deb_sain').val();
    var deb_produit = $('#deb_produit').val();
    var deb_destination = $('#deb_destination').val();
    var deb_av_cale = $('#deb_av_cale').val();
    var deb_av_produit = $('#deb_av_produit').val();
    var deb_av_destination = $('#deb_av_destination').val();
    var transfert_sain_avaries = $('#transfert_sain_avaries').val();
     var transfert_sain = $('#transfert_sain').val();
     var transfert_avaries = $('#transfert_avaries').val();
      var transfert_sain_deb = $('#transfert_sain_deb').val();
      var navire=$('#input_navire_initiale').val();
  
    
    

      //var type_dec = $('#type_dec').val();


        $.ajax({
        url:'ajax/crud/afficher_situation.php',
        method:'post',
        data:{idDate:idDate,deb_client:deb_client,deb_cale:deb_cale,deb_produit:deb_produit,deb_destination:deb_destination,deb_av_cale:deb_av_cale,deb_av_produit:deb_av_produit,deb_av_destination:deb_av_destination,deb_sain:deb_sain,transfert_sain_avaries:transfert_sain_avaries,transfert_sain:transfert_sain,transfert_avaries:transfert_avaries,transfert_sain_deb:transfert_sain_deb,navire:navire},
        success: function(response){
            $('#sit').html(response);
           
     
       
        }
    });


 

  });
});