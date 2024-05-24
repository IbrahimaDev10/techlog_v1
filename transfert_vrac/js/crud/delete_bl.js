 function deleteAjax(id) {
    Swal.fire({
        title: 'Êtes-vous sûr?',
        text: 'Voulez-vous vraiment supprimer cette donnée?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, supprimer!',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            var dis_bl = $('#' + id + 'dis_bl_rm').text();
            var poids_sac = $('#' + id + 'poids_sac_rm').text();
            var id_produit = $('#' + id + 'id_produit_rm').text();
            var id_destination = $('#' + id + 'id_destination_rm').text();
            var id_navire = $('#' + id + 'id_navire_rm').text();
            var id_declaration = $('#' + id + 'id_declaration_rm').text();
            var client = $('#' + id + 'id_client_rm').text();
            var statut = $('#' + id + 'statut_rm').text();
            var transfert_sain = $('#transfert_sain').val();

            $.ajax({
                type: 'post',
                url: 'ajax/crud/delete_bl.php',
                data: {
                    delete_id: id,
                    dis_bl: dis_bl,
                    poids_sac: poids_sac,
                    id_produit: id_produit,
                    id_destination: id_destination,
                    id_navire: id_navire,
                    id_declaration: id_declaration,
                    statut: statut,
                    client: client,
                    transfert_sain: transfert_sain
                },
                success: function(response) {
                    $('#TableSain').html(response);
                }
            });
        }
    });
}
