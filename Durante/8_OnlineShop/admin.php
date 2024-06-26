<?php
session_start();
include "connessione.php";
include "src.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include "style.html"; ?>
    <title>Admin</title>
    <link rel="stylesheet" href="src/css/base.css">
    <link rel="stylesheet" href="src/css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php include "navbar.html"; ?><br><br><br>
    <center> <h3> Aggiungi un prodotto </h3> </center><br><br><br>

    <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <form method="POST" action="#">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Nome</span>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome prodotto" aria-label="Nome" aria-describedby="addon-wrapping" required>
                    </div><br>
                    <div class="mb-3">
                        <textarea class="form-control" id="descrizione" placeholder="Descrizione prodotto" name="descrizione" rows="3"></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Quantità</span>
                        <input type="number" class="form-control" name="quantita" id="quantita" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">€</span>
                        <span class="input-group-text">0.00</span>
                        <input type="text" class="form-control" name="pvu" id="pvu" aria-label="Dollar amount (with dot and two decimal places)" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="file" id="immagine" name="immagine">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3" id="submit" name="submit">Aggiungi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php

        if (isset($_POST['submit'])) {
            $nome = $_POST["nome"];
            $descrizione = null;
            $quantita = $_POST["quantita"];
            $pvu = $_POST["pvu"];
            $immagine = null;

            if(isset($_POST['descrizione'])){
                $descrizione = $_POST["descrizione"];
            }
            if(isset($_POST['immagine'])){
                $immagine = $_POST["immagine"];
            }
            
            aggiungiAlMagazzino($nome,$descrizione,$quantita,$pvu,$immagine);

        }

    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <?php include "footer.html"; ?>
</body>

</html>