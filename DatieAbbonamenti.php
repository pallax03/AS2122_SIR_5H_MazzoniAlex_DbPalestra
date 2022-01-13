<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/stylephp.css">
    <title>Dati</title>
</head>
<body>
    <?php
    session_start();
    include 'ConnectDb.php';
    $cookie_name = "User";
    if(!isset($_COOKIE[$cookie_name]))//Se il cookie scade allora l'utente dovra' riaccedere
    {
        header('Location: index.php');//AMORE PER QUESTA FUNZIONE
        die(); 
    }

    $UtenteScelto = $_POST["hiddenUser"];
    $arrayName = ["Nome: ", "Cognome: ", "Email: ", "Password: ", "Data di Nascita: ", "Sesso: ", "Username: ", "Telefono: "];
    $arrayDBValue = ['firstname', 'lastname', 'email', 'psw', 'birthday', 'sesso', 'username', 'telefono'];
    $n = count($arrayName);
    echo "<div class=\"Tavolo\"> ";
    $sql = "SELECT * FROM User WHERE IdUser = '".$UtenteScelto."'";
    $result = mysqli_query($conn, $sql);
    mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    echo "<h1>Dati di ".$row['email'].": </h1>";
    $row['psw'] = "#####";
    for ($j=0; $j < $n; $j=$j+2) 
    {   
        echo "<div class=\"divRow\"> ";
        echo "<div class=\"spaziomini\"> <p class=\"Scadenza\">". $arrayName[$j] ."<p class=\"fieldmini\">".$row[$arrayDBValue[$j]]."</p></p></div>";
        echo "<div class=\"spaziomini\"> <p class=\"Scadenza\">". $arrayName[$j+1] ."<p class=\"fieldmini\">".$row[$arrayDBValue[$j+1]]."</p></p></div>";
        echo "</div>";
    }

    echo "</br></br>";
    $sql = "SELECT * FROM Subscription WHERE Fk_IdUser = '".$UtenteScelto."'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) 
    {
        echo "<div class=\"centra\"><h2><span>Abbonamento:</span></h2></div>";
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) 
        {
            echo "<div class=\"divRow\"> ";
                echo "<div class=\"Tabella\">";
                    echo "<p class=\"Scadenza\">Valido da ".$row['DataInizio']." fino a ".$row['DataFine']."</p>";
                echo "</div>";
                echo "<div class=\"spaziobtn\">";
                    echo "<p class=\"likeBtnShow\">Costo: ".$row['Costo']." €</p>";
                echo "</div>";
            echo "</div>";
            $_SESSION['subscriptiondata'] = $row;

            $sql = "SELECT * FROM include WHERE Fk_IdSubscription = '".$row['IdSubscription']."'";
            $resultS = mysqli_query($conn, $sql);
            if (mysqli_num_rows($resultS) > 0) 
            {
                    $i=0;
                // output data of each row
                while($rowS = mysqli_fetch_assoc($resultS)) 
                {
                    $_SESSION['servicedata'][$i] = $rowS['Fk_IdService'];
                    $i++;
                }
            }

            echo "<div class=\"centra\"><h2><span>Servizi:</span></h2></div>";
            echo "<div class=\"divRow\">";
                echo "<div class=\"centra\">";
                    $sql = "SELECT * FROM Service";
                    $resultS = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($resultS) > 0) 
                    {
                        $i=0;
                        while($rowS = mysqli_fetch_assoc($resultS)) 
                        {   
                            $flag = false;
                            for ($i=0; $i < count($_SESSION['servicedata']); $i++) 
                            { 
                                if($_SESSION['servicedata'][$i]==$rowS['IdService'])
                                {
                                    $flag=true;
                                }
                            }
                            
                            if($flag)
                            {
                                echo "<div class=\"spaziologin\">";
                                    echo "<p class=\"prova\">";
                                        echo "<label class=\"container\">".$rowS['Nome']."";
                                            echo "<input type=\"checkbox\" checked disabled><span class=\"checkmark\"</span>";
                                        echo "</label>";
                                    echo "</p>";
                                echo "</div>";
                            }
                            else
                            {
                                echo "<div class=\"spaziologin\">";
                                    echo "<p class=\"prova\">";
                                        echo "<label class=\"container\">".$rowS['Nome']."";
                                            echo "<input type=\"checkbox\" disabled><span class=\"checkmark\"</span>";
                                        echo "</label>";
                                    echo "</p>";
                                echo "</div>";
                            }
                        }
                    }
                echo "</div>";
            echo "</div>";
        }
    }
    else
    {
        echo "<div class=\"divRow\"> ";
            echo "<div class=\"spaziofrase\" id=\"ToChange2\">";
                echo "<p class=\"frasi\">Nessun abbonamento disponibile</p>";
            echo "</div>";
        echo "</div>";
    }

    mysqli_close($conn);
    ?>
    <a id="link" href="Lista.php"><input class="btnMark" type="button" value="Torna indietro"></a>
    </div>
    <footer align="center" >
        <a id="link" href="https://github.com/pallaxx"><p id="nome"> © – Copyright. - Alex Mazzoni ® - All rights reserved - Dati Admin™.</p></a>
    </footer>
</body>
</html>