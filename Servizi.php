<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/stylephp.css">
    <title>Abbonamento</title>
</head>
<body>

    <?php
    session_start();
    include 'CreateDb.php';
    $cookie_name = "User";
    if(!isset($_COOKIE[$cookie_name]) || $_SESSION['passepartout']!=1)//Se il cookie scade allora l'utente dovra' riaccedere e solo l'admin la puo' visualizzare
    {
        header('Location: index.php');//AMORE PER QUESTA FUNZIONE
        die();
    }
    ?>

    <div class="Tavolo">
    <?php
        echo "<h1>Modifica servizio:</h1>";
    ?>
        <form action="AggiungiServizi.php" method="POST" name="include">
            <div class="divRow">
                <div class="spazio">
                    <p class="titoli">
                        Nome del servizio:
                        <p>
                            <input type="text" class="field"  placeholder="Nome" name="f0" value="">
                        </p>
                    </p>
                </div>
                <div class="spazio">
                    <p class="titoli">
                        Costo:
                        <p>
                            <input type="text" class="field"  placeholder="100€" name="f1" value="">
                        </p>
                    </p>
                </div>
            </div>
            </br>
            <h1>Servizi disponibili:</h1>
            
            <?php
                $sql = "SELECT * FROM Service";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) 
                {
                    $i=0;
                    while($row = mysqli_fetch_assoc($result)) 
                    {   
                        if(($i%2)==0)
                            echo "<div class=\"divRow\">";

                            echo "<div class=\"spazio\">";
                                echo "<p class=\"field\">";
                                    echo "<label class=\"containerfield\">".$row['Nome']." ".$row['Costo']."€";
                                        echo "<input type=\"checkbox\" value=\"".$row['Nome']."\" name=\"interessi[]\" disabled><span class=\"checkmark\"></span>";
                                    echo "</label>";
                                echo "</p>";
                            echo "</div>";

                        if(($i%2)==1)
                            echo "</div>";
                        $i++;
                    }
                }
                if(($i%2)==1)
                    echo "</div>";

                echo "<input class=\"btnConfirm\" type=\"button\" value=\"Aggiungi Servizio\" onclick=\"ValidateData()\">"; 
        ?>
        </form>
        <a id="link" href="index.php"><input class="btnMark" type="button" value="Torna indietro"></a>
    </div>

    <footer align="center" >
        <a id="link" href="https://github.com/pallaxx"><p id="nome"> © – Copyright. - Alex Mazzoni ® - All rights reserved - Servizi™.</p></a>
    </footer>
    <script src="javascript/scriptabbonamento.js"></script>
</body>
</html>