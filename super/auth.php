<?php 

require('control_dc.php');
 ?>

<!doctype html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>INSERER DC</title>

	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="assets/modules/bootstrap-5.1.3/css/bootstrap.css">
	<!-- Style CSS -->
	<link rel="stylesheet" href="assets/css/style.css">
	<!-- Boostrap Icon-->
	<link rel="stylesheet" href="assets/modules/bootstrap-icons/bootstrap-icons.css">
</head>
<body>
 
	<div id="auth">
        
		<div class="row">
			<div class="col-lg-4 d-none d-lg-block">
				<div id="auth-left">
		
				</div>
			</div>
			<div class="col-lg-8 col-md-12">
				<div id="auth-right">
					

					 
                 <div class="col-lg-3">
                     <a class="lienforme" href="" style="background-color: blue; color: white;">cale 1</a> 
                   
                                    <div class="col-lg-3">
                     <a class="lienforme" href="">cale 2</a> 
                  
                                    <div class="col-lg-3">
                     <a class="lienforme" href="">cale 3</a> 
                  </div> 
                                    <div class="col-lg-3">
                     <a class="lienforme" href="">cale 4</a> 
                  </div>  
                                    <div class="col-lg-3">
                     <a class="lienforme" href="">cale 5</a> 
                  </div> 
                  </div> 
                   </div>
                    </div>
                                            
                             
                            


					
					<h1 class="auth-title">Insertion des declaration de chargement</h1>
					<p class="auth-subtitle mb-5">Input your data to register to our website.</p>
                    
		
					<form action="" method="POST">
					   
     
                        
 

                      <label for="exampleFormControlInput1" class="form-label">Inserer les produits de la cale 1</label>
                      
                    
                           <select id="p1" name="p1" class="mb-5 " onchange="pcale1()">
                            <option  selected>selectionner le nombre de produit de la cale 1</option>
                    

                        

                            <option value="1"> 1</option>
                            <option value="2"> 2</option>
                            <option value="3"> 3</option>
                            <option value="4"> 4</option>
                            <option value="5"> 5</option>
                            
                                
                            </select>

                            
                        
                        <div class="" id="cale1">

                            </div> 



                        
                      <label for="exampleFormControlInput1" class="form-label">Inserer les produits de la cale 2</label>
                      
                           <select id="p2" name="p2" class="mb-5 " onchange="pcale2()">
                            <option  selected>selectionner le nombre de produit de la cale 2</option>
                    

                        

                            <option value="1"> 1</option>
                            <option value="2"> 2</option>
                            <option value="3"> 3</option>
                            <option value="4"> 4</option>
                            <option value="5"> 5</option>
                            
                                
                            </select>

                            
                        
                        <div class=" mb-4" id="cale2">

                            </div>  
                                                                   
                        
                      <label for="exampleFormControlInput1" class="form-label">Inserer les produits de la cale 3</label>
                      </div>
                      <div class="form-group position-relative has-icon-left mb-4">
                           <select id="p3" name="p3" class="mb-5 " onchange="pcale3()">
                            <option  selected>selectionner le nombre de produit de la cale 3</option>
                    

                        

                            <option value="1"> 1</option>
                            <option value="2"> 2</option>
                            <option value="3"> 3</option>
                            <option value="4"> 4</option>
                            <option value="5"> 5</option>
                            
                                
                            </select>

                            
                       
                        <div class=" mb-4" id="cale3">

                            </div>  


                          
                      <label for="exampleFormControlInput1" class="form-label">Inserer les produits de la cale 4</label>
                      </div>
                      <div class="form-group position-relative has-icon-left mb-4">
                           <select id="p4" name="p4" class="mb-5 " onchange="pcale4()">
                            <option  selected>selectionner le nombre de produit de la cale 4</option>
                    

                        

                            <option value="1"> 1</option>
                            <option value="2"> 2</option>
                            <option value="3"> 3</option>
                            <option value="4"> 4</option>
                            <option value="5"> 5</option>
                            
                                
                            </select>

                            
                        
                        <div class="form-group position-relative has-icon-left mb-4" id="cale4">

                            </div>                              

                         <div class="form-group position-relative has-icon-left mb-4">
                      <label for="exampleFormControlInput1" class="form-label">Inserer les produits de la cale 5</label>
                      </div>
                      <div class="form-group position-relative has-icon-left mb-4">
                           <select id="p5" name="p5" class="mb-5 " onchange="pcale5()">
                            <option  selected>selectionner le nombre de produit de la cale 5</option>
                    

                        

                            <option value="1"> 1</option>
                            <option value="2"> 2</option>
                            <option value="3"> 3</option>
                            <option value="4"> 4</option>
                            <option value="5"> 5</option>
                            
                                
                            </select>

                            
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4" id="cale5">

                            </div> 

                      
					</form>
 </div>
				</div>
			</div>
			
		</div>
	</div>
		
	 

	<!-- General JS Scripts -->
	<script src="assets/js/atrana.js"></script>

	<!-- JS Libraies -->
	<script src="assets/modules/jquery/jquery.min.js"></script>
	<script src="assets/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
	<script src="assets/modules/popper/popper.min.js"></script>
 
    <!-- Template JS File -->
	<script src="assets/js/script.js"></script>
	<script src="assets/js/custom.js"></script>

      <script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function pcale1(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('cale1').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","cale1.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('p1');
                idp1 = sel.options[sel.selectedIndex].value;
                xhr.send("idP1="+idp1);
            }
        </script>

       <script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function pcale2(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('cale2').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","cale1.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('p2');
                idp2 = sel.options[sel.selectedIndex].value;
                xhr.send("idP2="+idp2);
            }
        </script>


        <script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function pcale3(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('cale3').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","cale1.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('p3');
                idp3 = sel.options[sel.selectedIndex].value;
                xhr.send("idP3="+idp3);
            }
        </script>        
 

        <script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function pcale4(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('cale4').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","cale1.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('p4');
                idp4 = sel.options[sel.selectedIndex].value;
                xhr.send("idP4="+idp4);
            }
        </script>


        <script type='text/javascript'>
 
            function getXhr(){
                                var xhr = null; 
                if(window.XMLHttpRequest) // Firefox et autres
                   xhr = new XMLHttpRequest(); 
                else if(window.ActiveXObject){ // Internet Explorer 
                   try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                }
                else { // XMLHttpRequest non supporté par le navigateur 
                   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                   xhr = false; 
                } 
                                return xhr;
            }
 
            /**
            * Méthode qui sera appelée sur le clic du bouton
            */
            function pcale5(){
                var xhr = getXhr();
                // On définit ce qu'on va faire quand on aura la réponse
                xhr.onreadystatechange = function(){
                    // On ne fait quelque chose que si on a tout reçu et que le serveur est OK
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        // On se sert de innerHTML pour rajouter les options à la liste
                        document.getElementById('cale5').innerHTML = leselect;

                    }
                }
 
                // Ici on va voir comment faire du post
                xhr.open("POST","cale1.php",true);
                // ne pas oublier ça pour le post
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                // ne pas oublier de poster les arguments
                // ici, l'id de l'auteur
                sel = document.getElementById('p5');
                idp5 = sel.options[sel.selectedIndex].value;
                xhr.send("idP5="+idp5);
            }
        </script>


 </body>
</html>
