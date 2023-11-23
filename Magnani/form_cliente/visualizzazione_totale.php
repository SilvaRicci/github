<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>input in php</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <style>
        .sfondo {
            background-color: #AFCBFF;
        }

        .container {
            width: 700px;
            margin-top: 100px;
            margin-bottom: 50px;
            padding: 20px;
            background-color: #0E1C36;
            border-radius: 10px;
            color: white;
        }

        .container button {
            border: none;
            border-radius: 5px;
            margin-top: 30px;
            background-color: white;
            padding: 6px;
            width: 60px;
        }

        .container button:hover {
            background-color: #AFCBFF;
        }

        .div-tabella {
            border-radius: 10px;
            overflow: hidden;
        }
    </style>
</head>

<body class="sfondo">
    <form action="#" method="POST">
        <div class="container">

            <table class="table table-hover table-bordered mb-0">
                <tr>
                    <th scope='row'>ID</th>
                    <td>Cognome</td>
                    <td>Nome</td>
                    <td>Classe</td>
                    <td>Sezione</td>
                    <td>Indirizzo</td>
                </tr>


                <?php
                include "connessione.php";

                $result = $db_connection->query("SELECT codice_fiscale, cognome, nome, data_nascita, residenza, citta, provincia, regione, password, ripeti_password");
                $rows = $result->num_rows;

                
                if($rows > 0){
                    //se ci sono righe row è true, altrimenti false e non fa il for
                    while($row = $result->fetch_assoc()){
                        echo "<tr>
                            <td><a href='visualizzazione_singolo.php?idval=$row[codice_fiscale]' target='blank'>$row[codice_fiscale]</a></td>
                            <td>$row</td>
                        
                        "
                    } 
                }
                


                
                    $codice_fiscale = $_POST["codice_fiscale"];
                    $cognome = $_POST["cognome"];
                    $nome = $_POST["nome"];

                    $data_nascita = $_POST["data_nascita"];
                    $residenza = $_POST["residenza"];
                    $citta = $_POST["citta"];

                    $provincia = $_POST["provincia"];
                    $regione = $_POST["regione"];

                    $password = $_POST["password"];
                    $ripeti_password = $_POST["ripeti_password"];




                    







                    $db_connection->close();
                
                ?>
            </table>



        </div>
    </form>


</body>

</html>