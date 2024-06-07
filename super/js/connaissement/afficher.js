$(document).ready(function(){
$(document).on('click','button[data-role=voir_connaissement]',function(){
var navire=$("#valeur_navire").val();

	
	$.ajax({
		url:'tableau/connaissement/ajax/index.php',
		method:'post',
		data:{navire:navire},
		success: function(response){
			$('#content').html(response);
			/*$('#'+id).children('td[data-target=cales]').text(cale);
		$('#'+id).children('td[data-target=nom_chargeur]').text(ch);
		$('#'+id).children('td[data-target=conditionnement]').text(cond+' KGS');
		//$('#modif_dec').modal('toggle');*/
		//$('#modif_transitv').modal('toggle');
		}
	});

	});
});
