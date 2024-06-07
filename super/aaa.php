<?php
  header("Content-type: image/png");
  
  $largeur = 250;
  $hauteur = 200;
  $img = imageCreate($largeur, $hauteur);
  $rouge = imageColorAllocate($img, 200, 100, 100);
  $noir  = imageColorAllocate($img, 0, 0, 0);

  // Fond transparent
  //imageColorTransparent($img, $rouge);
  
  $titre        = "Histogramme";
  $titre_police = 5;
  
  imageString($img, $titre_police,
             ($largeur-imageFontWidth($titre_police)*strlen("$titre"))/2,
             0, $titre, $noir);
  //imageTTFText($img, 15, 90, $largeur-10, $hauteur-10, $noir, "Gigi.ttf",
  //           "Copyright PHP Facile !");

  imagePNG($img);
  imageDestroy($img);  
?> 