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
    $cookie_name = "User";
    if(!isset($_COOKIE[$cookie_name]))//Se il cookie scade allora l'utente dovra' riaccedere
    {
        header('Location: index.php');//AMORE PER QUESTA FUNZIONE
        die(); 
    }

    $arrayName = ["Nome: ", "Cognome: ", "Email: ", "Password: ", "Data di Nascita: ", "Sesso: ", "Username: ", "Telefono: "];
    $arrayDBValue = ['firstname', 'lastname', 'email', 'psw', 'birthday', 'sesso', 'username', 'telefono'];
    $n = count($arrayName);
    echo "<div class=\"Tavolo\"> ";

    echo "<h1>Ciao ".$_SESSION["userdata"]['firstname'].", i tuoi dati: </h1>";
    $tmp = $_SESSION["userdata"]['psw'];
    $_SESSION["userdata"]['psw'] = "#####";
    for ($j=0; $j < $n; $j=$j+2) 
    {   
        echo "<div class=\"divRow\"> ";
        echo "<div class=\"spazio\"> <p class=\"titoli\">". $arrayName[$j] ."<p class=\"field\">".$_SESSION["userdata"][$arrayDBValue[$j]]."</p></p></div>";
        echo "<div class=\"spazio\"> <p class=\"titoli\">". $arrayName[$j+1] ."<p class=\"field\">".$_SESSION["userdata"][$arrayDBValue[$j+1]]."</p></p></div>";
        echo "</div>";
    }
    $_SESSION["userdata"]['psw'] = $tmp ;
    ?>
    <a id="link" href="index.php"><input class="btnMark" type="button" value="Torna indietro"></a>
    </div>
    <footer align="center" >
        <a id="link" href="https://github.com/pallaxx"><p id="nome"> © – Copyright. - Alex Mazzoni ® - All rights reserved - Dati™.</p></a>
    </footer>
</body>
</html>