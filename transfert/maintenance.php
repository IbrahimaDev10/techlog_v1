<script>
  function filtreCamions() {
    var input = document.getElementById("myInput");
    var filter = input.value.toUpperCase();
    var div = document.getElementById("camionList");
    var camions = div.getElementsByClassName("camion");

    var hiddenCamions = [];

    for (var i = 0; i < camions.length; i++) {
      var camion = camions[i];
      var numCamion = camion.innerText.toUpperCase();
      if (numCamion.indexOf(filter) > -1) {
        camion.style.display = "";
      } else {
        camion.style.display = "none";
        hiddenCamions.push(camion); // Ajouter le lien masqué à la liste des liens masqués
      }
    }

    if (filter.length > 0) {
      div.style.display = "block";
    } else {
      div.style.display = "none";
    }

    // Supprimer les liens masqués du flux du document
    for (var i = 0; i < hiddenCamions.length; i++) {
      div.removeChild(hiddenCamions[i]);
    }
  }

  function stockerId(element) {
    var camionId = element.id;
    var input2 = document.getElementById("val_input2");
    input2.value = camionId;

   /* var camionText = element.innerText;
    var input = document.getElementById("myInput");
    input.value = camionText;
    var div = document.getElementById("camionList");
    div.style.display = "none"; */
    var camtext = document.getElementById("n_camions");
     var camionText = camtext.innerText;
    var input = document.getElementById("myInput");
    input.value = camionText;
    var div = document.getElementById("camionList");
    div.style.display = "none";

    var trtext = document.getElementById("transp");
     var transpText = trtext.innerText;
    var input2 = document.getElementById("myInputTransp");
    input2.value = transpText;
    
  }
</script>


      $(document).ready(function(){
        $("#myInput").keyup(function(){
            var search=$(this).val();
            $.ajax({
                url:'action.php',
                method:'post',
                data:{query:search},
                success:function(response){
                    $("#camionList").html(response);
                }
            });
        });
      });  