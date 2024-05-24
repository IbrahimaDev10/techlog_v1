      function filtreca() {
        var search = document.getElementById('myInput').value;
        var camionList = document.getElementById('camionList');
         var input2 = document.getElementById("val_input2");
         if(search==''){
            $('#val_input2').val('');
         }

        camionList.style.display="block";
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'ajax/recherche_transport/camion.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            camionList.innerHTML = xhr.responseText;
          }
        };
        xhr.send('query=' + search);
      }

       function stockerIds(element) {
    var camionId = element.id;
    var input2 = document.getElementById("val_input2");
    input2.value = camionId;

   /* var camionText = element.innerText;
    var input = document.getElementById("myInput");
    input.value = camionText;
    var div = document.getElementById("camionList");
    div.style.display = "none"; */
    var camtext = document.getElementById("n_camions"+camionId);
    var camionText = camtext.innerText;
    var input = document.getElementById("myInput");
    input.value = camtext.innerText;
    var div = document.getElementById("camionList");
    div.style.display = "none";

    var trtext = document.getElementById("transp"+camionId);
     var transpText = trtext.innerText;
    var input3 = document.getElementById("myInputTransp");
    input3.value = transpText;
     

    
  }