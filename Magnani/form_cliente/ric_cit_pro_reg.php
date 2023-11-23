<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ricerca per città, provincia, regione</title>
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
    <form action="#" method="POST">
        <div class="container">
            <div class="text-vis">
                Ricerca per Città, Provincia, Regione
            </div>

            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" id="citta" name="citta" placeholder="Città">
                </div>
                <!--Provincia-->
                <div class="col">
                    <select class="form-select" aria-label="Default select example" name="provincia">
                        <option value="" selected disabled>Seleziona provincia</option>
                        <?php
                        include "connessione.php";
                        $pro = $db_connection->query("SELECT DISTINCT provincia FROM clienti_20_11_2023");
                        $rows_pro = $pro->num_rows;

                        if ($rows_pro > 0) {
                            while ($row_pro = $pro->fetch_assoc()) {
                                echo "<option value='$row_pro[provincia]'>$row_pro[provincia]</option>";
                            }
                        }
                        $pro->close();
                        ?>
                    </select>

                </div>
                <!--Regione-->
                <div class="col">
                    <select class="form-select" aria-label="Default select example" name="regione">
                        <option value="" selected disabled>Seleziona regione</option>
                        <?php
                        include "connessione.php";
                        $reg = $db_connection->query("SELECT DISTINCT regione FROM clienti_20_11_2023");
                        $rows_reg = $reg->num_rows;

                        if ($rows_reg > 0) {
                            while ($row_reg = $reg->fetch_assoc()) {
                                echo "<option value='$row_reg[regione]'>$row_reg[regione]</option>";
                            }
                        }
                        $reg->close();
                        ?>
                    </select>

                </div>
            </div>


            <div class="mb-5">
                <center>
                    <button id="invia" name="invia" type="submit">Invia</button>
                </center>
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
                    </tr>


                    <?php
                    include "connessione.php";

                    if (isset($_POST["invia"])) {
                        $result = $db_connection->query("SELECT codice_fiscale, cognome, nome, data_nascita, residenza, citta, provincia, regione, password, ripeti_password FROM clienti_20_11_2023");
                        $rows = $result->num_rows;

                        $ric_citta = $_POST["citta"];
                        $ric_provincia = $_POST["provincia"];
                        $ric_regione = $_POST["regione"];



                        if ($rows > 0) {
                            //se ci sono righe $result $row è true e i valori della riga vanno dentro $row, altrimenti false e non fa il while
                            while ($row = $result->fetch_assoc()) {
                                $temp = 0;
                                if ("$row[citta]" == "$ric_citta" && "$row[provincia]" == "$ric_provincia" && "$row[regione]" == "$ric_regione") {
                                    $temp++;
                                    echo "<tr>
                                        <td>$row[codice_fiscale]</td><td>$row[cognome]</td><td>$row[nome]</td>
                                        <td>$row[data_nascita]</td><td>$row[residenza]</td><td>$row[citta]</td>
                                        <td>$row[provincia]</td><td>$row[regione]</td></tr>";
                                        echo "1";
                                }
                                
                                if ($temp==0 && "$row[citta]" == "$ric_citta" && "$row[provincia]" == "$ric_provincia") {
                                    $temp++;
                                    echo "<tr>
                                        <td>$row[codice_fiscale]</td><td>$row[cognome]</td><td>$row[nome]</td>
                                        <td>$row[data_nascita]</td><td>$row[residenza]</td><td>$row[citta]</td>
                                        <td>$row[provincia]</td><td>$row[regione]</td></tr>";
                                        echo "2";
                                }
                                
                                if ($temp==0 && "$row[citta]" == "$ric_citta" && "$row[regione]" == "$ric_regione") {
                                    $temp++;
                                    echo "<tr>
                                        <td>$row[codice_fiscale]</td><td>$row[cognome]</td><td>$row[nome]</td>
                                        <td>$row[data_nascita]</td><td>$row[residenza]</td><td>$row[citta]</td>
                                        <td>$row[provincia]</td><td>$row[regione]</td></tr>";
                                        echo "3";
                                }
                                
                                if ($temp==0 && "$row[provincia]" == "$ric_provincia" && "$row[regione]" == "$ric_regione") {
                                    $temp++;
                                    echo "<tr>
                                        <td>$row[codice_fiscale]</td><td>$row[cognome]</td><td>$row[nome]</td>
                                        <td>$row[data_nascita]</td><td>$row[residenza]</td><td>$row[citta]</td>
                                        <td>$row[provincia]</td><td>$row[regione]</td></tr>";
                                        echo "4";
                                }
                                
                                if ($temp==0 && "$row[citta]" == "$ric_citta") {
                                    $temp++;
                                    echo "<tr>
                                        <td>$row[codice_fiscale]</td><td>$row[cognome]</td><td>$row[nome]</td>
                                        <td>$row[data_nascita]</td><td>$row[residenza]</td><td>$row[citta]</td>
                                        <td>$row[provincia]</td><td>$row[regione]</td></tr>";
                                        echo "5";
                                }
                                
                                if ($temp==0 && "$row[provincia]" == "$ric_provincia") {
                                    $temp++;
                                    echo "<tr>
                                        <td>$row[codice_fiscale]</td><td>$row[cognome]</td><td>$row[nome]</td>
                                        <td>$row[data_nascita]</td><td>$row[residenza]</td><td>$row[citta]</td>
                                        <td>$row[provincia]</td><td>$row[regione]</td></tr>";
                                        echo "6";
                                }
                                
                                if($temp==0 && "$row[regione]" == "$ric_regione") {
                                    $temp++;
                                    echo "<tr>
                                        <td>$row[codice_fiscale]</td><td>$row[cognome]</td><td>$row[nome]</td>
                                        <td>$row[data_nascita]</td><td>$row[residenza]</td><td>$row[citta]</td>
                                        <td>$row[provincia]</td><td>$row[regione]</td></tr>";
                                        echo "7";
                                }
                            }
                        }
                        $result->close();
                        $db_connection->close();
                    }



                    ?>
                </table>
            </div>
        </div>
    </form>
</body>

</html>