<!doctype html>

<?php
    include "../config/path.php";
    include $CONN_PATH;
    session_start();
    if(!isset($_SESSION['CF'])){
      header("Location: $LOGIN_PATH");
    }
    

    //recupero id utente con conseguente record dal database
    $CF = $_SESSION['CF'];
            
    $result = $db_connection->query("SELECT * FROM utente WHERE CF = '$CF'");                      
    $rows = $result->num_rows;                                                                                                                         
    $row = $result->fetch_assoc();   
?>


<?php
  function getVisitData(){
    include "../config/path.php";
    include $CONN_PATH;
    $CF = $_SESSION['CF'];

    $query = "SELECT * FROM `visita` WHERE `CF_utente` = '$CF'";

    $resultVisit = $db_connection->query($query);                      
    $rowsVisit = $resultVisit->num_rows;         
    
    echo '
      <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
          <table class="table mt-5 table-striped table-hover thead-success">
            <thead>
                <tr>
                <th scope="col">Tipologia</th>
                <th scope="col">Data</th>
                <th scope="col">Ora</th>
                <th scope="col">Modifica</th>
                <th scope="col">Elimina</th>
                </tr>
            </thead>
            <tbody>
        </div>
        <div class="col-2"></div>
      </div>';

    if($rowsVisit>0){

      while($rowVisit = $resultVisit->fetch_assoc()){
        echo "<tr>";
        echo "<th scope='row' class='secondary'>$rowVisit[tipologia]</th>";
        echo "<th scope='row'> $rowVisit[data] </th>";
        echo "<th scope='row'> $rowVisit[ora] </th>";
        
        //BOTTONI DA SISTEMARE
        echo "<th scope='row'> <a href='modificaVisite.php?id=$rowVisit[id]'><button class='btn btn-primary'><i class='bi bi-trash-fill'></i></button></a></th>";
        echo "<th scope='row'> <a href='eliminaVisite.php?id=$rowVisit[id]'><button class='btn btn-danger'><i class='bi bi-trash-fill'></i></button></a></th>";
        echo "</tr>";
      } 
    }

    echo "<th scope='row'><a href='aggiungiVisita.php'> Aggiungi una visita </a> </th><th></th><th></th><th></th><th></th></tr>";

    echo '</tbody></table>';
  
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
  <nav class="navbar navbar-dark navbar-expand-lg bg-success">
    
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">

      <div class="row">
        <ul class="navbar-nav mr-auto">
        
        <!-- 1# button -> Torna a home.php -->
        <li class="nav-item px-5 pt-3">
            <a class="nav-link" href="<?php echo"$HOME_PATH"?>">Home <span class="sr-only"></span></a>
          </li>

        <!-- 2# button -> Vai a index.php -->
          <li class="nav-item px-5 pt-3">
            <a class="nav-link" href="<?php echo"$INDEX_PATH"?>">Panoramica <span class="sr-only"></span></a>
          </li>

          <!-- Torna a home.php -->
          <a class="navbar-brand px-5" href="<?php echo"$HOME_PATH"?>">
            <img src="<?php echo"$LOGO_PATH"?>" alt="Logo" width="50" height="50">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <!-- 3# button -> Vai a visite.php -->
          <li class="nav-item active nav-underline px-5 pt-3">
            <a class="nav-link active nav-underline" href="<?php echo"$VISITE_PATH"?>">Visite</a>
          </li>
          
          <!-- 4# button -> Vai a profilo.php/logout.php -->
          <li class="nav-item dropdown px-5 pt-3">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Profilo
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo"$PROFILE_PATH"?>">Visualizza</a></li>
              <li><hr class="dropdown-divider"></li>
              <?php 
                  if(!isset($_SESSION['CF'])){
                    echo '<li><a class="dropdown-item" href="'.$SIGNUP_PATH.'">Signup</a></li>';
                    echo '<li><a class="dropdown-item" href="'.$LOGIN_PATH.'">Login</a></li>';
                  }else{
                    echo '<li><a class="dropdown-item" href="'.$LOGOUT_PATH.'">Logout</a></li>';
                  }
              ?>
              
            </ul>
          </li>       
        </ul>

      </div>
    </div>
  </nav>
  <!-- Fine navbar -->

  <?php       
        getVisitData();
    ?>

  
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
