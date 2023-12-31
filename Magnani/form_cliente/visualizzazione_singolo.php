<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>visualizzazione singolo</title>
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
            min-width: 700px;
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

        .text-vis {
            font-size: 40px;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            margin-bottom: 100px;
            text-align: center;
        }
    </style>

</head>

<body class="sfondo">
    <div class="container">
        <div class="text-vis">
            Visualizzazione Singolo
        </div>
        <div class="">
            <table class="table table-hover table-bordered rounded mb-0">
                <tr>
                    <th scope='row'>CF</th>
                    <td>Cognome</td>
                    <td>Nome</td>
                    <td>Data di nascita</td>
                    <td>Residenza</td>
                    <td>Città</td>
                    <td>Provincia</td>
                    <td>Regione</td>
                    <td>Password</td>
                    <td>Password ripetuta</td>
                </tr>


                <?php
                include "connessione.php";

                $result = $db_connection->query("SELECT codice_fiscale, cognome, nome, data_nascita, residenza, citta, provincia, regione, password, ripeti_password FROM clienti_20_11_2023");
                $rows = $result->num_rows;

                $cfval = $_GET["cfval"];

                if ($rows > 0) {
                    //se ci sono righe $result $row è true e i valori della riga vanno dentro $row, altrimenti false e non fa il while
                    while ($row = $result->fetch_assoc()) {
                        if("$row[codice_fiscale]" == $cfval){
                           echo "<tr>
                            <td>$row[codice_fiscale]</td>
                            <td>$row[cognome]</td>
                            <td>$row[nome]</td>

                            <td>$row[data_nascita]</td>
                            <td>$row[residenza]</td>
                            <td>$row[citta]</td>

                            <td>$row[provincia]</td>
                            <td>$row[regione]</td>

                            <td>$row[password]</td>
                            <td>$row[ripeti_password]</td>
                        "; 
                        }
                        
                    }
                }
                $result->close();
                $db_connection->close();
                ?>
            </table>
        </div>
    </div>
</body>

</html>