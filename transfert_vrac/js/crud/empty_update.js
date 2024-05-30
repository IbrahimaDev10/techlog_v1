    $(document).ready(function(){
    $(document).on('click','a[data-role=btn_update]',function(){
        
   // Mettre à jour le texte de l'option existante
  

        
        
  

        var poids_sac = $('#poids_sacssain').val();

       //  $('#avaries_debarquement').css('display','none');

           


         
         
                
        $('#enregistrement').modal('toggle');

  
        
        $.ajax({
        url:'ajax/crud/empty_update.php',
        method:'post',
        data:{poids_sac:poids_sac},
        success: function(response){
            $('#TableSain').html(response);
            descendre_dernier_enregistrement();

        
        }
    });

        
    });


});