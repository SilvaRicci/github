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
  function getTypeData(){
    include "../config/path.php";
    include $CONN_PATH;

    $CF = $_SESSION['CF'];
    $id = $_GET['id'];

    $query = "SELECT * FROM `visita` WHERE `CF_utente` = '$CF' AND `id` = $id";
    $result = $db_connection->query($query);

    if($result->num_rows > 0){
        $row=$result->fetch_assoc();
        
        echo "
        <tr>
            <th scope='row' class='secondary'>
                <input type='text' class='form-control' id='tipologia' name='tipologia' value='$row[tipologia]' disabled>
            </th>
            <th scope='row'>
                <input type='date' class='form-control' id='data' name='data' value='$row[data]'>
            </th>
            <th scope='row'>
                <input type='time' class='form-control' id='ora' name='ora' value='$row[ora]'>
            </th>
        </tr>
        ";
    }
  }

  function modifyData(){
    include "../config/path.php";
    include $CONN_PATH;

    $CF = $_SESSION['CF'];
    $id = $_GET['id'];

    $data = $_POST['data'];  
    $ora = $_POST['ora']; 
    
    $query = "UPDATE `visita` SET `data`='$data',`ora`='$ora' WHERE `CF_utente` = '$CF' AND `id` = $id";
    $db_connection->query($query);
    
    $db_connection->close();

    header("Location: visite.php");
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

  <form action='#' method='POST'>
    <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
            <table class="table mt-5 thead-success">
                <thead>
                    <tr>
                    <th scope="col">Tipologia</th>
                    <th scope="col">Data</th>
                    <th scope="col">Ora</th>
                    </tr>
                </thead>
                <tbody>
            </div>
            <div class="col-2"></div>
        </div>

            <?php getTypeData(); ?>

        </tbody></table>

        <br><center><button type='submit' id='submit_btn' name='submit_btn' class='btn btn-success'>Modifica</button></center>
    </form>
  <?php       
  
        if(isset($_POST['submit_btn'])){
            modifyData();
        }
    ?>

  
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
