$(document).ready(function() {
    $(document).on('click', 'a[data-role=ajouter_produits]', function() {

        var produit=$('#produit_add_prod').val();
        var qualite=$('#qualite_add_prod').val();
        var tarif=$('#tarif_add_prod').val();
        var categories=$('#categories_add_prod').val();
        $('#form_ajout_produit').modal('toggle');
        // $('#form_ajout_manifeste').modal('toggle');
        


        if(produit!='' && qualite!='' && categories!=''){

        $.ajax({
            url: 'produit/ajax/ajout.php',
            method: 'post',
            data: {produit:produit,qualite:qualite,tarif:tarif,categories:categories},

            success: function(response) {
                $('#content').html(response);
                //$('#form_ajout_manifeste').modal('toggle');
                
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
