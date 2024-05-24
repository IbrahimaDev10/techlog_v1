function filtreChau() {
        var search = document.getElementById('myInputc').value;
        var camionList = document.getElementById('camionListc');
        camionList.style.display="block";
        if(search==''){
            $('#val_input2c').val('');
        }
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'ajax/recherche_transport/chauffeur.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            camionList.innerHTML = xhr.responseText;
          }
        };
        xhr.send('query=' + search);
      }

        function stockerIdc(element) {
    var camionId = element.id;
    var input2 = document.getElementById("val_input2c");
    input2.value = camionId;

    var camionText = element.innerText;
    var input = document.getElementById("myInputc");
    input.value = camionText;
    var div = document.getElementById("camionListc");
    div.style.display = "none";

  input2.value = chauffeurId;

    
  }