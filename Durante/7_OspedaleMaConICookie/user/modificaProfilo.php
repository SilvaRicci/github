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


    function getTypeData(){
      include "../config/path.php";
      include $CONN_PATH;
  
      $CF = $_SESSION['CF'];
  
      $query = "SELECT * FROM `utente` WHERE `CF` = '$CF'";
      $result = $db_connection->query($query);
  
      if($result->num_rows > 0){
          $row=$result->fetch_assoc();

          echo "
          <div class='container text-center'>
            <div class='row py-4'>
              <div class='col-6'>
                <input type='text' class='form-control' id='CF' name='CF' value='$row[CF]' disabled>
              </div>
              <div class='col-3'>
                <input type='text' class='form-control' id='cognome' name='cognome' value='$row[cognome]'>
              </div>
              <div class='col-3'>
                <input type='text' class='form-control' id='nome' name='nome' value='$row[nome]'>
              </div>
            </div>
            <div class='row py-4'>
              <div class='col-3'>
                <input type='text' class='form-control' id='indirizzo' name='indirizzo' value='$row[indirizzo]'>
              </div>
              <div class='col-3'>
                <input type='text' class='form-control' id='comune' name='comune' value='$row[comune]'>
              </div>
              <div class='col-3'>
                <input type='text' class='form-control' id='CAP' name='CAP' value='$row[CAP]'>
              </div>
              <div class='col-3'>
                <input type='text' class='form-control' id='provincia' name='provincia' value='$row[provincia]'>
              </div>
            </div>
            <div class='row py-4'>
              <div class='col-4'>
                <input type='date' class='form-control' id='dataNascita' name='dataNascita' value='$row[dataNascita]'>
              </div>
              <div class='col-4'>
                <input type='password' class='form-control' id='password' name='password' value='12345678' disabled>
              </div>
              <div class='col-4'>
              <input type='password' class='form-control' id='newPsw' name='newPsw' value=''>
              </div>
            </div>
          </div>
          ";
      }
    }

    function dataVerify($cognome,$nome,$indirizzo,$comune,$CAP,$provincia,$dataNascita){
        $isOk=true;

        if($cognome==""){
            $isOk=false;
            echo "Cognome non inserito <br />";
        }
        if($nome==""){
            $isOk=false;
            echo "Nome non inserito <br />";
        }
        if($indirizzo==""){
            $isOk=false;
            echo "Indirizzo non inserito <br />";
        }
        if($comune==""){
            $isOk=false;
            echo "Comune non inserito <br />";
        }
        if($CAP==""){
            $isOk=false;
            echo "CAP non inserito <br />";
        }
        if($provincia==""){
            $isOk=false;
            echo "Provincia non inserita <br />";
        }
        if($dataNascita==""){
            $isOk=false;
            echo "Data di nascita non inserita <br />";
        }
        //eventuali nuovi controlli sulla password
        return $isOk;
    }

    function modifyData(){
        include "../config/path.php";
        include $CONN_PATH;
    
        $CF = $_SESSION['CF'];
    
        $cognome = $_POST["cognome"];
        $nome = $_POST["nome"]; 
        $indirizzo = $_POST["indirizzo"];
        $comune = $_POST["comune"];
        $CAP = $_POST["CAP"];
        $provincia = $_POST["provincia"];
        $dataNascita = $_POST["dataNascita"];

        $newPsw = $_POST["newPsw"];

        //AGGIUNGERE CONTROLLO PER VECCHIA PASSWORD

        if(dataVerify($cognome,$nome,$indirizzo,$comune,$CAP,$provincia,$dataNascita)){
            if($newPsw!=''){
                $password = password_hash($password,PASSWORD_DEFAULT);
                $query = "UPDATE `utente` SET `cognome`='$cognome',`nome`='$nome',`indirizzo`='$indirizzo',`comune`='$comune',`CAP`='$CAP',`provincia`='$provincia',`dataNascita`='$dataNascita',`password`='$password' WHERE `CF` = '$CF'";
            }else{
                $query = "UPDATE `utente` SET `cognome`='$cognome',`nome`='$nome',`indirizzo`='$indirizzo',`comune`='$comune',`CAP`='$CAP',`provincia`='$provincia',`dataNascita`='$dataNascita' WHERE `CF` = '$CF'";
            }
            
            $db_connection->query($query);
        
            echo '<script>  window.location.href = "profilo.php"; </script>';
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
          <li class="nav-item px-5 pt-3">
            <a class="nav-link" href="<?php echo"$VISITE_PATH"?>">Visite</a>
          </li>
          
          <!-- 4# button -> Vai a profilo.php/logout.php -->
          <li class="nav-item dropdown active nav-underline px-5 pt-3">
            <a class="nav-link dropdown-toggle  active nav-underline" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
        <?php getTypeData(); ?>
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
