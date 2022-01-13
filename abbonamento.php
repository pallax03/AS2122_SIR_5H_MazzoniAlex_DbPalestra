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
    $cookie_name = "User";
    if(!isset($_COOKIE[$cookie_name]))//Se il cookie scade allora l'utente dovra' riaccedere
    {
        header('Location: index.php');//AMORE PER QUESTA FUNZIONE
        die();
    }
    ?>

    <div class="Tavolo">
    <?php
    
        if($_SESSION['boolsub'] == 0)
            echo "<h1>Crea il tuo abbonamento:</h1>";
        else
            echo "<h1>Modifica il tuo abbonamento:</h1>";
    ?>
        <form action="include.php" method="POST" name="include">
            <div class="divRow">
                <div class="spazio">
                    <p class="titoli">
                        Data di inizio:
                        <p>
                            <?php
                                if($_SESSION['boolsub'] == 0)
                                    echo "<input type=\"date\" class=\"inputdataStart\"  placeholder=\"Data di Inizio\" name=\"f0\" value=\"\">";
                                else
                                    echo "<input type=\"date\" class=\"inputdataStart\" placeholder=\"Data di Inizio\" name=\"f0\" value=".$_SESSION['subscriptiondata']['DataInizio'].">";
                            ?>
                        </p>
                    </p>
                </div>
                <div class="spazio">
                    <p class="titoli">
                        Data di fine:
                        <p>
                            <?php
                                if($_SESSION['boolsub'] == 0)
                                    echo "<input type=\"date\" class=\"inputdataEnd\" placeholder=\"Data di Fine\" name=\"f1\" value=\"\">";
                                else
                                    echo "<input type=\"date\" class=\"inputdataEnd\" placeholder=\"Data di Fine\" name=\"f1\" value=".$_SESSION['subscriptiondata']['DataFine'].">";
                            ?>
                        </p>
                    </p>
                </div>
            </div>
            </br>
            <h1>Seleziona i servizi:</h1>
            <?php
            include 'ConnectDb.php';
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
                                    $flag=false;
                                    echo "<label class=\"containerfield\">".$row['Nome']." ".$row['Costo']."€";
                                    for($j=0;$j<count($_SESSION['servicedata']);$j++)
                                    {
                                        if($_SESSION['servicedata'][$j] == $i+1)
                                        {
                                            echo "<input type=\"checkbox\" value=\"".$row['Nome']."\" name=\"interessi[]\" checked ><span class=\"checkmark\"></span>";
                                            $flag=true; 
                                        }
                                    }
                                    if(!$flag)
                                        echo "<input type=\"checkbox\" value=\"".$row['Nome']."\" name=\"interessi[]\" ><span class=\"checkmark\"></span>";
                                    
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


                if($_SESSION['boolsub'] == 0)
                    echo "<input class=\"btnConfirm\" type=\"button\" value=\"Crea il tuo abbonamento\" onclick=\"ValidateData()\">";
                else
                    echo "<input class=\"btnConfirm\" type=\"button\" value=\"Modifica il tuo abbonamento\" onclick=\"ValidateData()\">";   
            ?>          
        </form>
        <?php
            if($_SESSION['boolsub'] != 0)
            {
                echo "<form action=\"RimuoviAbbonamento.php\" method=\"POST\" name=\"rimuovi\">";
                    echo "<input class=\"btnMark\" type=\"button\" value=\"Elimina il tuo abbonamento\" onclick=\"RimuoviAbbonamento()\">";
                echo "</form>";
            }
        ?>
        <a id="link" href="index.php"><input class="btnMark" type="button" value="Torna indietro"></a>
    </div>

    <footer align="center" >
        <a id="link" href="https://github.com/pallaxx"><p id="nome"> © – Copyright. - Alex Mazzoni ® - All rights reserved - Abbonamento™.</p></a>
    </footer>
    <script src="javascript/scriptabbonamento.js"></script>
</body>
</html>