<?php session_start(); ?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">

    <title>Index</title>

    <style>
        body {
            text-align: center;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            border-color: blue navy;
            font-size: 1vw;
        }

        td {
            width: 10vw;
            border-color: blue navy;
        }

        a {
            background-color: green;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }

        fieldset {
            width: 60%;
            text-align: center;
            margin: auto;
        }

        h2 {
            color: red;
        }

        h3 {
            color: red;
        }
    </style>

</head>

<body>

    <br><br>
    <fieldset>

        <form action="filtri.php" method="POST">

            <h2>Visualizza Dati</h2>

            <h3>Filtra Per:</h3>

            <label for="area">Area Geografica: </label>
            <select name="area">
                <option value=""></option>
                <option value="NORD EST">NORD EST</option>
                <option value="NORD OVEST">NORD OVEST</option>
                <option value="CENTRO">CENTRO</option>
                <option value="SUD">SUD</option>
                <option value="ISOLE">ISOLE</option>
            </select>

            <br><br>

            <label for="regione">Regione: </label>
            <select name="regione">
                <option value=""></option>
                <option value="Abruzzo">Abruzzo</option>
                <option value="Basilicata">Basilicata</option>
                <option value="Calabria">Calabria</option>
                <option value="Campania">Campania</option>
                <option value="Elimilia_Romagna">Elimilia Romagna</option>
                <option value="Friuli">Friuli-Venezia G.</option>
                <option value="Lazio">Lazio</option>
                <option value="Liguria">Liguria</option>
                <option value="Lombardia">Lombardia</option>
                <option value="Marche">Marche</option>
                <option value="Molise">molise</option>
                <option value="Piemonte">Piemonte</option>
                <option value="Puglia">Puglia</option>
                <option value="Sardegna">Sardegna</option>
                <option value="Sicilia">Sicilia</option>
                <option value="Toscana">Toscana</option>
                <option value="Trentino">Trentino alto adige</option>
                <option value="Umbria">Umbria</option>
                <option value="Valle d'aosta">Valle d'aosta</option>
                <option value="Veneto">Veneto</option>
            </select>

            <br><br>
            <label for="provincia">Provincia: </label>
            <input type="text" name="provincia" maxlength="20">


            <br><br>
            <label for="comune">Comune: </label>
            <input type="text" name="comune" maxlength="20">

            <br><br>
            <input type="submit" name="cerca" value="Ricerca">
            <input type="reset" value="Reset">


            <?php
            $conn = new mysqli("localhost", "root", "", "dbFinale");

            $risultatiperpage = 25;

            if (isset($_GET['page'])) {
                if ($_GET['page'] > 1) {
                    $start = ($_GET['page'] - 1) * $risultatiperpage;
                } else {
                    $start = 0;
                }
            } else {
                $start = 0;
            }
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $sql = $conn->query("SELECT COUNT(*) as conteggio from prova");
            $array = $sql->fetch_assoc();
            $totalerighe = $array['conteggio'];
            $pages = ceil($totalerighe / $risultatiperpage);
            $query = $conn->query("SELECT * FROM prova LIMIT " . $start . "," . $risultatiperpage);
            $Previous = $page - 1;
            $Next = $page + 1;
            ?>

            <?php

            echo "<br><br><br>";

            if (count($_SESSION["result"]) > 0) {
                echo "<table align=" . '"' . "center" . '"' . ">
                          <tr>
                            <th>ID</th>
                            <th>A.S.</th>
                            <th>AreaGeografica</th>
                            <th>REGIONE</th>
                            <th>PROVINCIA</th>
                            <th>CODICEISTITUTO</th>
                            <th>DENOMINAZIONE</th>
                            <th>CODICESCUOLA</th>
                            <th>NOMINATIVO</th>
                            <th>INDIRIZZO</th>
                            <th>CAP</th>
                            <th>CODCOMUNE</th>
                            <th>COMUNE</th>
                            <th>CARATTERISTICASCUOLA</th>
                            <th>GRADOSCUOLA</th>
                            <th>SEDEDIRETTIVO</th>
                            <th>OMNICOMPRENSIVO</th>
                            <th>EMAIL</th>
                            <th>PEC</th>
                            <th>SITOWEB</th>
                            <th>SEDE</th>
                          </tr>";


                for ($i = $start; $i < $risultatiperpage + $start; $i++) {

                    if (array_key_exists($i, $_SESSION["result"])) {
                        $row = $_SESSION["result"][$i];

                        echo "<tr>";

                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['ANNOSCOLASTICO'] . "</td>";
                        echo "<td>" . $row['AREAGEOGRAFICA'] . "</td>";
                        echo "<td>" . $row['REGIONE'] . "</td>";
                        echo "<td>" . $row['PROVINCIA'] . "</td>";
                        echo "<td>" . $row['CODICEISTITUTORIFERIMENTO'] . "</td>";
                        echo "<td>" . $row['DENOMINAZIONEISTITUTORIFERIMENTO'] . "</td>";
                        echo "<td>" . $row['CODICESCUOLA'] . "</td>";
                        echo "<td>" . $row['DENOMINAZIONESCUOLA'] . "</td>";
                        echo "<td>" . $row['INDIRIZZOSCUOLA'] . "</td>";
                        echo "<td>" . $row['CAPSCUOLA'] . "</td>";
                        echo "<td>" . $row['CODICECOMUNESCUOLA'] . "</td>";
                        echo "<td>" . $row['DESCRIZIONECOMUNE'] . "</td>";
                        echo "<td>" . $row['DESCRIZIONECARATTERISTICASCUOLA'] . "</td>";
                        echo "<td>" . $row['DESCRIZIONETIPOLOGIAGRADOISTRUZIONESCUOLA'] . "</td>";
                        echo "<td>" . $row['INDICAZIONESEDEDIRETTIVO'] . "</td>";
                        echo "<td>" . $row['INDICAZIONESEDEOMNICOMPRENSIVO'] . "</td>";
                        echo "<td>" . $row['INDIRIZZOEMAILSCUOLA'] . "</td>";
                        echo "<td>" . $row['INDIRIZZOPECSCUOLA'] . "</td>";
                        echo "<td>" . $row['SITOWEBSCUOLA'] . "</td>";
                        echo "<td>" . $row['SEDESCOLASTICA'] . "</td>";

                        echo "</tr>";
                    }
                }

                echo "</table>";
            } else {
                echo "Nessun risultato";
            }
            ?>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li>
                        <a href="visualizzaFiltri.php?page=<?= $Previous; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo; Previous</span>
                        </a>
                    </li>
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    <li>
                        <a href="visualizzaFiltri.php?page=<?= $Next; ?>" aria-label="Next">
                            <span aria-hidden="true">Next &raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
    </fieldset>
    </form>

</body>

</html>