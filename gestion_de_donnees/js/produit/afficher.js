$(document).ready(function(){
$(document).on('click','a[data-role=voir_produit]',function(){
var a=0;

	
	$.ajax({
		url:'produit/ajax/index.php',
		method:'post',
		data:{a:a},
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
