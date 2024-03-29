<?php
    session_start();
    include "connessione.php";
    include "src.php";

    if(!isset($_SESSION['username'])){
        header("Location: login.php");
      }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">OShop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
            </li>
            <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
        </ul>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        </div>
    </div>
    </nav>

    <?php 

        echo "Benvenuto".$_SESSION['username'];
    
        $query = "SELECT prodotto.id_prodotto,nome_prodotto,pvu_prodotto,img FROM prodotto LEFT JOIN immagini ON immagini.id_prodotto=prodotto.id_prodotto";
        //$query = "SELECT id_prodotto,nome_prodotto,pvu_prodotto FROM prodotto";

        $result = $db_connection->query($query);                      
        $rows = $result->num_rows;  
        
        
        ?>

    <div class="container">
        <div class="row">
            <?php foreach($result as $item):?>
                <div class="col-3">
                        <form action="#" method="POST">
                            <div class="card" style="width: 18rem;">
                                <img src="<?php echo $item['img']; ?>" class="card-img-top" alt="<?php echo $item['nome_prodotto']; ?> bello/a">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $item['nome_prodotto']; ?></h5>

                                    <br>

                                    <div class="input-group">
                                        <span class="input-group-text">Quantità</span>
                                        <input type="number" class="form-control" id="quantita" name="quantita">
                                    </div>

                                    <br>

                                    <div class="input-group">
                                        <span class="input-group-text">€</span>
                                        <span class="input-group-text"><?php echo $item['pvu_prodotto']; ?></span>
                                    </div>

                                    <input type="hidden" name="id" id="id" value='<?php echo $item['id_prodotto']; ?>' readonly>

                                    <br>

                                    <button type="submit" id="submit_btn" name="submit_btn" class="btn btn-primary">Aggiungi al carrello</button>
                                </div>
                            </div>
                        </form>
                    </div>
            <?php endforeach; ?>
        </div>
    </div>

    <p> <a href="carrello.php" class="btn btn-primary">Vai al carrello</a> </p>

<?php

    if(isset($_POST['submit_btn'])){
        $id = $_POST["id"];
        $quantita = $_POST['quantita'];

        if($quantita<0){
            echo "Inserisci la quantità.";
        }else{
            aggiungiAlCarrello($id,$quantita);
        }
    }

?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>