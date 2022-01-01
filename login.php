<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/stylephp.css">
    
</head>
<body>
    <script>
        window.onload = function()
        { 
            var button1 = document.getElementById('Show1');
            var div1 = document.getElementById('ToChange1');

            button1.onmouseover = function() {
                div1.className = 'spaziofrase hovered';
            }

            button1.onmouseout = function() {
                div1.className = 'spaziofrase';
            }
            var button2 = document.getElementById('Show2');
            var div2 = document.getElementById('ToChange2');

            button2.onmouseover = function() {
                div2.className = 'spaziofrase hovered';
            }

            button2.onmouseout = function() {
                div2.className = 'spaziofrase';
            }
        };
    </script>
    
    <?php
    $cookie_name = "User";
    if(!isset($_COOKIE[$cookie_name])) {
        //Credenziali inserite dal POST
        $email = $_POST["f0"];
        $psw = md5($_POST["f1"]);
      } else {
        //Credenziali inserite dal Cookie
        $value = explode(';', $_COOKIE[$cookie_name]);
        $email = $value[0];
        $psw = $value[1];
      }
        include 'CreateDB.php';
        //Stampa dati
        echo "<div class=\"Tavolo\"> ";
        $arrayValue = ['firstname', 'lastname', 'email', 'psw', 'birthday', 'sesso', 'username', 'telefono'];
        $arrayName = ["Nome: ", "Cognome: ", "Email: ", "Password: ", "Data di Nascita: ", "Sesso: ", "Username: ", "Telefono: "];
        $arrayService = ['SPA', 'Sala Pesi', 'Corso Spinning', 'Boxe'];
        $_SESSION['servicedata'][0]=0;
        for($i=0;$i<count($_SESSION['servicedata']);$i++)
            $_SESSION['servicedata'][$i]=0;

        $_SESSION['boolsub']=1;
        $n = count($arrayName);

        $sql = "SELECT * FROM User WHERE email = '".$email."'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) 
        {
            // output data of each row
            while($row = $result->fetch_assoc()) 
            {
                if($row["psw"]==$psw)
                {
                    if(!isset($_COOKIE[$cookie_name]))
                    {
                        // $_SESSION
                        $cookie_name = "User";
                        $cookie_value = $email.";".$psw;
                        setcookie($cookie_name, $cookie_value, time() + 1800); // 86400 = 1 day
                        header('Location: index.php'); //AMORE PER QUESTA FUNZIONE
                    }
                    $_SESSION['userdata'] = $row;
                    // echo "<h1>Bentornato ".$row[$arrayValue[0]]."!</h1> ";
                    // for ($j=0; $j < $n; $j=$j+2) 
                    // { 
                    //     echo "<div class=\"divRow\"> ";
                    //     echo "<div class=\"spazio\"> <p class=\"titoli\">". $arrayName[$j] ."<p class=\"field\">".$row[$arrayValue[$j]]."</p></p></div>";
                    //     echo "<div class=\"spazio\"> <p class=\"titoli\">". $arrayName[$j+1] ."<p class=\"field\">".$row[$arrayValue[$j+1]]."</p></p></div>";
                    //     echo "</div>";
                    // }
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
                    echo "<a id=\"link\" href=\"index.php\"><input class=\"btnMark\" type=\"button\" value=\"Torna indietro\"></a>";
                    die();
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
            echo "<a id=\"link\" href=\"index.php\"><input class=\"btnMark\" type=\"button\" value=\"Torna indietro\"></a>";
            die();
        }

        echo "<h1>Bentornato ". $_SESSION["userdata"]['firstname'] ."!</h1> ";
    ?>

        <div class="divRow">
            <form action="Dati.php" method="POST" name="Dati">
                <div class="spaziofrase" id="ToChange1">
                    <p class='frasi'>Vuoi visualizzare i tuoi dati?</p>
                </div>
                <div class="spaziobtn">
                    <p><input type="submit" id="Show1" class="btnShow" value="Si"/></p>
                </div>
            </form>
        </div>

    <?php
        
        $sql = "SELECT * FROM Subscription WHERE Fk_IdUser = '".$_SESSION["userdata"]['IdUser']."'";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) 
        {
            // output data of each row
            while($row = $result->fetch_assoc()) 
            {
                echo "<div class=\"divRow\"> ";
                    echo "<form action=\"abbonamento.php\" method=\"POST\" name=\"abbonamento\">";
                        echo "<div class=\"spaziofrase\" id=\"ToChange2\">";
                            echo "<p class=\"frasi\">il tuo abbonamento:</p>";
                        echo "</div>";
                        echo "<div class=\"spaziobtn\">";
                            echo "<p><input type=\"submit\" id=\"Show2\" class=\"btnShow\" value=\"Modifica\"/></p>";
                        echo "</div>";
                    echo "</form>";
                echo "</div>";

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
                

                echo "<div class=\"centra\"><h2><span>Servizi:</span></h2></div>";
                echo "<div class=\"divRow\">";
                    echo "<div class=\"centra\">";
                if ($resultS->num_rows > 0) 
                {
                        $i=0;
                    // output data of each row
                    while($rowS = $resultS->fetch_assoc()) 
                    {
                        $_SESSION['servicedata'][$i] = $rowS['Fk_IdService'];
                        $i++;
                    }
                }

                $j=0;
                for($i=0;$i<count($arrayService);$i++)
                {
                    if($_SESSION['servicedata'][$j]==$i+1)
                    {
                        echo "<div class=\"spaziologin\">";
                            echo "<p class=\"prova\">";
                                echo "<label class=\"container\">".$arrayService[$i]."";
                                    echo "<input type=\"checkbox\" checked disabled><span class=\"checkmark\"</span>";
                                echo "</label>";
                            echo "</p>";
                        echo "</div>";
                        
                        if(count($_SESSION['servicedata'])-1>$j)
                            $j++;
                    }
                    else
                    {
                        echo "<div class=\"spaziologin\">";
                            echo "<p class=\"prova\">";
                                echo "<label class=\"container\">".$arrayService[$i]."";
                                    echo "<input type=\"checkbox\" disabled><span class=\"checkmark\"</span>";
                                echo "</label>";
                            echo "</p>";
                        echo "</div>";
                    }
                }
                    echo "</div>";
                echo "</div>";
            }
        }
        else
        {
            $_SESSION['boolsub']=0;
            echo "<div class=\"divRow\"> ";
                echo "<form action=\"Abbonamento.php\" method=\"POST\" name=\"abbonamento\">";
                    echo "<div class=\"spaziofrase\" id=\"ToChange2\">";
                        echo "<p class=\"frasi\">Vuoi sottoscrivere un abbonamento?</p>";
                    echo "</div>";
                    echo "<div class=\"spaziobtn\">";
                        echo "<p><input type=\"submit\" id=\"Show2\" class=\"btnShow\" value=\"Sottoscrivi\"/></p>";
                    echo "</div>";
                echo "</form>";
            echo "</div>";
        }

        mysqli_close($conn);
    ?>
    <a id="link" href="Logout.php"><input class="btnMark" type="button" value="Esci"></a>
    </div>
    <footer align="center" >
        <a id="link" href="https://github.com/pallaxx"><p id="nome"> © – Copyright. - Alex Mazzoni ® - All rights reserved - Home™.</p></a>
    </footer>
</body>
</html>