<!doctype html>

<?php
    include "../config/path.php";
    include $CONN_PATH;
    session_start();
    if(!isset($_SESSION['username'])){
      header("Location: $LOGIN_PATH");
    } 


    function getTypeData(){
      include "../config/path.php";
      include $CONN_PATH;
  
      $id = $_GET['id'];
  
      $query = "SELECT * FROM `visita` WHERE `id` = '$id'";
      $result = $db_connection->query($query);
  
      if($result->num_rows > 0){
          $row=$result->fetch_assoc();

          echo "
          <form action='#' method='POST'>
            <div class='container text-center'>
              <div class='row py-4'>
                <div class='col-6'>
                  <input type='text' class='form-control' id='tipologia' name='tipologia' value='$row[tipologia]' disabled>
                </div>
                <div class='col-3'>
                  <input type='date' class='form-control' id='data' name='data' value='$row[data]'>
                </div>
                <div class='col-3'>
                  <input type='time' class='form-control' id='ora' name='ora' value='$row[ora]'>
                </div>
              </div>
            </form>
          ";
      }
    }

    function dataVerify($data,$ora){
        $isOk=true;

        if($data==""){
            $isOk=false;
            echo "Data non inserita <br />";
        }
        if($ora==""){
            $isOk=false;
            echo "Ora non inserita <br />";
        }
        return $isOk;
    }

    function modifyData(){
        include "../config/path.php";
        include $CONN_PATH;
    
        $id = $_GET['id'];

        $data = $_POST["data"]; 
        $ora = $_POST["ora"];

        if(dataVerify($data,$ora)){
          $query = "UPDATE `visita` SET `data`='$data',`ora`='$ora' WHERE `id` = '$id'";
        
          $db_connection->query($query);
          $db_connection->close();
      
          echo '<script>  window.location.href = "visiteUtenti.php?id='.$id.'"; </script>';
        }else{
            echo "Errore nel'inserimento dei dati";
        }
      }
  

?>



<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Durante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body style = "background-color:white">

 <!-- Inizio navbar -->
 <nav class="navbar navbar-dark navbar-expand-lg bg-danger">
    
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">

      <div class="row">
        <ul class="navbar-nav mr-auto">
        
        <!-- 1# button -> Torna a home.php -->
        <li class="nav-item px-5 pt-3">
            <a class="nav-link" href="<?php echo"$ADMIN_PATH"?>">Home <span class="sr-only"></span></a>
          </li>

        <!-- 2# button -> Vai a index.php -->
        <li class="nav-item dropdown px-5 pt-3 active nav-underline ">
            <a class="nav-link dropdown-toggle active nav-underline" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Gestione
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo"$AUTENTI_PATH"?>">Utenti</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="<?php echo"$AVISITEUTENTI_PATH"?>">Visite</a></li>
            </ul>
          </li> 

          <!-- Torna a home.php -->
          <a class="navbar-brand px-5" href="<?php echo"$ADMIN_PATH"?>">
            <img src="<?php echo"$ALOGO_PATH"?>" alt="Logo" width="50" height="50">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <!-- 3# button -> Vai a visite.php -->
          <li class="nav-item px-5 pt-3">
            <a class="nav-link" href="<?php echo"$AVISITE_PATH"?>">Visite</a>
          </li>
          
          <!-- 4# button -> Vai a profilo.php/logout.php -->
          <li class="nav-item dropdown px-5 pt-3">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Profilo
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo"$APROFILE_PATH"?>">Visualizza</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="<?php echo"$LOGOUT_PATH"?>">Logout</a></li>
              
            </ul>
          </li>       
        </ul>

      </div>
    </div>
  </nav>
  <!-- Fine navbar -->

  <form action='#' method='POST'>
        <?php getTypeData(); ?>
        <br><center><button type='submit' id='submit_btn' name='submit_btn' class='btn btn-danger'>Modifica</button></center>
    </form>

  <?php       
        if(isset($_POST['submit_btn'])){
          modifyData();
      }
    ?>

  
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
