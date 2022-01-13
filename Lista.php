<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/stylephp.css">
    <title>Lista Dati</title>
</head>
<body>
    <?php
    session_start();
    include 'ConnectDb.php';
    $cookie_name = "User";
    if(!isset($_COOKIE[$cookie_name]) || $_SESSION['passepartout']!=1)//Se il cookie scade allora l'utente dovra' riaccedere e solo l'admin la puo' visualizzare
    {
        header('Location: index.php');//AMORE PER QUESTA FUNZIONE
        die();
    }
    echo "<div class=\"Tavolo\"> ";

    echo "<h1>Lista di tutti i clienti:</h1>";
    $sql = "SELECT * FROM User";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) 
    {
        $i=0;
        while($row = mysqli_fetch_assoc($result)) 
        {
            echo "<div class=\"divRow\">";
                echo "<form action=\"DatieAbbonamenti.php\" method=\"POST\" name=\"Dati\">";
                    echo "<div class=\"spaziofrase\">";
                        echo "<p class=\"frasi\">".($i+1)." ".$row['firstname']." ".$row['email']."</p>";
                    echo "</div>";
                    echo "<div class=\"spaziobtn\">";
                        echo "<p><input type=\"submit\" class=\"btnShow\" value=\"Visualizza Dati\"/></p>";
                    echo "</div>";
                    echo "<input type=\"text\" name=\"hiddenUser\" value=\"".$row['IdUser']."\" hidden>";
                echo "</form>";
            echo "</div>";
            $i++;
        }
    } 
    ?>
    <a id="link" href="index.php"><input class="btnMark" type="button" value="Torna indietro"></a>
    </div>
    <footer align="center" >
        <a id="link" href="https://github.com/pallaxx"><p id="nome"> © – Copyright. - Alex Mazzoni ® - All rights reserved - Lista™.</p></a>
    </footer>
</body>
</html>