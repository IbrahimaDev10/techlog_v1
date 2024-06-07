$(document).ready(function() {
    $(document).on('click', 'a[data-role=afficher_form_poids_manifeste]', function() {
        var id = $(this).data('id');
        $('#id_manifeste').val(id);
        $('#form_ajout_manifeste').modal('toggle');
    });
});