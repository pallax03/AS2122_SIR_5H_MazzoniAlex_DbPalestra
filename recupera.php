<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/stylephp.css">
    <title>Recupera</title>
</head>
<body>
    <?php
        include 'CreateDB.php';
        //Stampa dati
        echo "<div class=\"Tavolo\"> ";
        $arrayValue = ['firstname', 'lastname', 'email', 'psw', 'birthday', 'sesso', 'username', 'telefono'];
        $arrayName = ["Nome: ", "Cognome: ", "Email: ", "Password: ", "Data di Nascita: ", "Sesso: ", "Username: ", "Telefono: "];
        $n = count($arrayName);

        //CREDENZIALI INSERITE NEL LOGIN
        $email = $_POST["f0"];

        
        $sql = "SELECT * FROM User WHERE email = '".$email."'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) 
        {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) 
            {
                echo "<h1>Email trovata!</h1> ";
                echo "<div class=\"divRow\"> ";
                    echo "<div class=\"spazio\"> <p class=\"titoli\"> Email: <p class=\"field\">";
                        echo $email;
                    echo "</p></p></div>";

                    echo "<div class=\"spazio\"> <p class=\"titoli\"> Password: <p class=\"field\" id=\"error\">";
                        echo $row['psw'];
                    echo "</p></p></div>";
                echo "</div>";
                echo "<a id=\"link\" href=\"recupera.html\"><input class=\"btnMark\" type=\"button\" value=\"Torna indietro\"></a>";
            }
        } 
        else 
        {
            echo "<h1>Email non trovata!</h1> ";
            echo "<div class=\"divRow\"> ";
                echo "<div class=\"spazio\"> <p class=\"titoli\"> Email: <p class=\"field\" id=\"error\">";
                    echo $email." non trovata!";
                echo "</p></p></div>";
            echo "</div>";
            
            echo "<div class=\"divRow\"> ";
                echo "<div class=\"spaziologin\">";
                    echo "<a id=\"link\" href=\"index.php\"><input class=\"btnMark\" type=\"button\" value=\"Torna indietro\"></a>";
                echo "</div>";
                echo "<div class=\"spaziologin\">";
                    echo "<a id=\"link\" href=\"registra.html\"><input class=\"btnMark\" type=\"button\" value=\"Registrati\"></a>";
                echo "</div>"; 
            echo "</div>";
        }
        
        //footer
        echo "<footer align=\"center\">";
        echo "<a id=\"link\" href=\"https://github.com/pallaxx\">";
        echo "<p id=\"nome\"> © – Copyright. - Alex Mazzoni ® - All rights reserved - Recupera™.</p>";
        echo "</a>";
        echo "</footer>";
        mysqli_close($conn);
    ?>

</body>
</html>