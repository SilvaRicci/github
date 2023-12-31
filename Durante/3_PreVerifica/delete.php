<!doctype html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Durante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <<body style = "background-color:white">
    <center><br><br><h1>Cancellazione di valutazioni</h1><br>   
    
    <?php include "connessione.php"; ?>

    <div class="container">
<form action="#" method="POST">
  <div class="form-row">
    <?php

      echo '<div class="form-group my-2">
    <label for="codiceFiscale">Codice fiscale</label>
    <select id="codiceFiscale" name="codiceFiscale" class="form-control">
      <option selected value="0">Scegli il codice fiscale</option>';

      $result = $db_connection->query("SELECT DISTINCT CodFisc FROM valutazione");                      
      $rows = $result->num_rows;  
      echo $rows;
      if($rows > 0){  
        while($row = $result->fetch_assoc()){                                                    
          echo '<option value='."$row[CodFisc]".'>'."$row[CodFisc]".'</option>';
        }
      }
      echo '</select> </div>';


      echo '<div class="form-group my-2">
    <label for="codiceContenuto">Codice contenuto</label>
    <select id="codiceContenuto" name="codiceContenuto" class="form-control">
      <option selected value="0">Scegli il codice contenuto</option>';

      $result = $db_connection->query("SELECT DISTINCT CodContenuto FROM valutazione");                      
      $rows = $result->num_rows;  
      echo $rows;
      if($rows > 0){  
        while($row = $result->fetch_assoc()){                                                    
          echo '<option value='."$row[CodContenuto]".'>'."$row[CodContenuto]".'</option>';
        }
      }
      echo '</select> </div>';

    ?>

  <button type="submit" id="submit_btn" name="submit_btn" class="btn btn-primary">Elimina</button>
</form>
</div>

  <?php                                                                     
        
        if (isset($_POST["submit_btn"])) {
            
            $codiceFiscale = $_POST["codiceFiscale"];
            $codiceContenuto = $_POST["codiceContenuto"];
            $isFiscale=true;
            $isContenuto=true;

            if($codiceFiscale==0){
              $isFiscale=false;
            }
            if($codiceContenuto==0){
              $isContenuto=false;
            }

            if(!$isFiscale AND !$isContenuto){
              echo "ao, inserisci qualcosa";
            }else{
                $result = $db_connection->query("DELETE FROM valutazione WHERE (CodFisc = '$codiceFiscale' AND CodContenuto = '$codiceContenuto')");                      
                echo("Operazione eseguita con successo!");
              }
      }
        $result->close();                                                                               
        $db_connection->close();                                                                                 


    ?>
  </tbody>
</table>

    </center>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>