<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/stylephp.css">
    <title>Login</title>
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
        $psw = $_POST["f1"];


        $sql = "SELECT * FROM User WHERE email = '".$email."'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) 
        {
            // output data of each row
            while($row = $result->fetch_assoc()) 
            {
                if($row["psw"]==$psw)
                {
                    echo "<h1>Benvenuto!</h1> ";
                    for ($j=0; $j < $n; $j=$j+2) 
                    { 
                        echo "<div class=\"divRow\"> ";
                        echo "<div class=\"spazio\"> <p class=\"titoli\">". $arrayName[$j] ."<p class=\"field\">".$row[$arrayValue[$j]]."</p></p></div>";
                        echo "<div class=\"spazio\"> <p class=\"titoli\">". $arrayName[$j+1] ."<p class=\"field\">".$row[$arrayValue[$j+1]]."</p></p></div>";
                        echo "</div>";
                    }
                }
                else
                {
                    echo "<h1>Credenziali non trovate!</h1> ";
                    echo "<div class=\"divRow\"> ";
                    echo "<div class=\"spazio\"> <p class=\"titoli\"> Email: <p class=\"field\">";
                    echo $email;
                    echo "</p></p></div>";
                    echo "<div class=\"spazio\"> <p class=\"titoli\"> Password: <p class=\"field\" id=\"error\">";
                    echo "Password non corretta!";
                    echo "</div>";
                }  
            }
        } 
        else 
        {
            echo "<h1>Credenziali non trovate!</h1> ";
            echo "<div class=\"divRow\"> ";
            echo "<div class=\"spazio\"> <p class=\"titoli\"> Email: <p class=\"field\" id=\"error\">";
            echo $email." non trovata!";
            echo "</p></p></div>";
            echo "</div>";
        }
        echo "<a id=\"link\" href=\"index.html\"><input class=\"btnMark\" type=\"button\" value=\"Torna indietro\"></a>";
        echo "</div>";
        
        //footer
        echo "<footer align=\"center\">";
        echo "<a id=\"link\" href=\"https://github.com/pallaxx\">";
        echo "<p id=\"nome\"> © – Copyright. - Alex Mazzoni ® - All rights reserved - Login™.</p>";
        echo "</a>";
        echo "</footer>";
        mysqli_close($conn);
    ?>

</body>
</html>