$(document).ready(function() {
    $(document).on('click', 'a[data-role=ajouter_navire]', function() {
        var formData = new FormData();
        formData.append('navire_add_nav', $('#navire_add_nav').val());
        formData.append('proprietaire_add_nav', $('#proprietaire_add_nav').val());
        formData.append('type_navire_add_nav', $('#type_navire_add_nav').val());
        formData.append('load_port_add_nav', $('#load_port_add_nav').val());
        formData.append('destination_add_nav', $('#destination_add_nav').val());
        formData.append('num_manifeste_add_nav', $('#num_manifeste_add_nav').val());
        formData.append('eta_add_nav', $('#eta_add_nav').val());
        formData.append('etb_add_nav', $('#etb_add_nav').val());
        formData.append('etd_add_nav', $('#etd_add_nav').val());

        $('#affreteur_add_nav:checked').each(function() {
            formData.append('affreteur_add_nav[]', $(this).val());
        });

        $('#client_add_nav:checked').each(function() {
            formData.append('client_add_nav[]', $(this).val());
        });
        $('#form_ajout_navire').modal('toggle');
        // $('#form_ajout_manifeste').modal('toggle');
        

        var navire=$('#navire_add_nav').val();
        var proprietaire=$('#proprietaire_add_nav').val();
        var type_navire=$('#type_navire_add_nav').val();
        if(navire!='' && proprietaire!='' && type_navire!=''){

        $.ajax({
            url: 'navire/ajax/ajout.php',
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
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
