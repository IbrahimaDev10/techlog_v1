$(document).ready(function() {
    $(document).on('click', 'a[data-role=ajouter_manifeste]', function() {
       
        

        var produit=$('#produit_manifeste').val();
        var poids=$('#poids_manifeste').val();
        var id=$('#id_manifeste').val();
        $('#form_ajout_manifeste').modal('toggle');
       
        if(produit!='' && poids!='' ){

        $.ajax({
            url: 'navire/ajax/ajout_manifeste.php',
            method: 'post',
            data: {produit:produit,poids:poids,id:id},

            success: function(response) {
                $('#content').html(response);
              // $('#form_ajout_manifeste').modal('toggle');
                
                
            }
        });

}

     else{
   Swal.fire({
        icon: 'error',
        title: 'Erreur',
        text: 'Veuillez remplir tous les champs obligatoires.',
        confirmButtonText: 'OK'
    });
    }


    });
});


