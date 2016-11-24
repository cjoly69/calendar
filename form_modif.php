<?php

 ?>
 <!DOCTYPE html>
 <html>
     <head>
         <meta charset="utf-8">
         <title>Modifier champs</title>
     </head>
     <body>
          <form action="submitModif.php" method="post">
               <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
               <input type="texte" id="titre" name="titre" placeholder="titre">
               <input type="date" id="debut" name="debut" placeholder="debut">
               <input type="date" id="fin" name="fin" placeholder="fin">
               <input type="mail" id="mail" name="mail" placeholder="votre email">
               <button type="submit" id="valider">Valider les modifs</button>
         </form>
     </body>
 </html>
