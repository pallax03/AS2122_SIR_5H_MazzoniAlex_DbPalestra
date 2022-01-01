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
            <div class="divRow">
                <div class="spazio">
                    <p class='field'>
                        <?php
                            $flag=false;
                            echo "<label class=\"containerfield\">SPA";
                            for($i=0;$i<count($_SESSION['servicedata']);$i++)
                            {
                                if($_SESSION['servicedata'][$i] == 1)
                                {
                                    echo "<input type=\"checkbox\" value=\"SPA\" name=\"interessi[]\" checked ><span class=\"checkmark\"></span>";
                                    $flag=true; 
                                }
                            }
                            if(!$flag)
                                echo "<input type=\"checkbox\" value=\"SPA\" name=\"interessi[]\" ><span class=\"checkmark\"></span>";
                            echo "</label>";
                        ?>
                    </p>
                </div>
                <div class="spazio">
                    <p class='field'>
                    <?php
                            $flag=false;
                            echo "<label class=\"containerfield\">Sala Pesi";
                            for($i=0;$i<count($_SESSION['servicedata']);$i++)
                            {
                                
                                if($_SESSION['servicedata'][$i] == 2)
                                {
                                    echo "<input type=\"checkbox\" value=\"Sala Pesi\" name=\"interessi[]\" checked ><span class=\"checkmark\"></span>";
                                    $flag=true; 
                                }
                            }
                            if(!$flag)
                                echo "<input type=\"checkbox\" value=\"Sala Pesi\" name=\"interessi[]\" ><span class=\"checkmark\"></span>";
                            echo "</label>";
                        ?>
                    </p>
                </div>
            </div>
            <div class="divRow">
                <div class="spazio">
                    <p class='field'>
                    <?php
                        $flag=false;
                        echo "<label class=\"containerfield\">Corso Spinning";
                        for($i=0;$i<count($_SESSION['servicedata']);$i++)
                        {
                            
                            if($_SESSION['servicedata'][$i] == 3)
                            {
                                echo "<input type=\"checkbox\" value=\"Corso Spinning\" name=\"interessi[]\" checked ><span class=\"checkmark\"></span>";
                                $flag=true; 
                            }
                        }
                        if(!$flag)
                            echo "<input type=\"checkbox\" value=\"Corso Spinning\" name=\"interessi[]\" ><span class=\"checkmark\"></span>";
                        echo "</label>";
                        ?>
                    </p>
                </div>
                <div class="spazio">
                    <p class='field'>
                    <?php
                        $flag=false;
                        echo "<label class=\"containerfield\">Boxe";
                        for($i=0;$i<count($_SESSION['servicedata']);$i++)
                        {
                            if($_SESSION['servicedata'][$i] == 4)
                            {
                                echo "<input type=\"checkbox\" value=\"Boxe\" name=\"interessi[]\" checked ><span class=\"checkmark\"></span>";
                                $flag=true; 
                            }
                        }
                        if(!$flag)
                            echo "<input type=\"checkbox\" value=\"Boxe\" name=\"interessi[]\" ><span class=\"checkmark\"></span>";
                        echo "</label>";
                        ?>
                    </p>
                </div>
            </div>
            
            <?php
                if($_SESSION['boolsub'] == 0)
                    echo "<input class=\"btnConfirm\" type=\"button\" value=\"Crea il tuo abbonamento\" onclick=\"ValidateData()\">";
                else
                    echo "<input class=\"btnConfirm\" type=\"button\" value=\"Modifica il tuo abbonamento\" onclick=\"ValidateData()\">";   
            ?>
            
            
        </form>
        <a id="link" href="index.php"><input class="btnMark" type="button" value="Torna indietro"></a>
    </div>

    <footer align="center" >
        <a id="link" href="https://github.com/pallaxx"><p id="nome"> © – Copyright. - Alex Mazzoni ® - All rights reserved - Abbonamento™.</p></a>
    </footer>
    <script src="javascript/scriptabbonamento.js"></script>
</body>
</html>