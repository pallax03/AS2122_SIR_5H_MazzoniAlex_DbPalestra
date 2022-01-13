<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/stylephp.css">
    <title>Registra</title>
</head>
<body>
    <?php
    include 'ConnectDb.php';

    //Stampa dati
    echo "<div class=\"Tavolo\"> ";
      
    $arrayName = ["Nome: ", "Cognome: ", "Email: ", "Password: ", "Data di Nascita: ", "Sesso: ", "Username: ", "Telefono: "];
    $n = count($arrayName);
    for($i=0; $i<$n; $i++)
      $row[] =$_POST["f".$i];

    //Vecchio modo
    // $sql = "INSERT INTO User (firstname, lastname, email, psw, birthday, sesso, username, telefono)
    //   VALUES ('".$row[0]."', '".$row[1]."', '".$row[2]."', '".$row[3]."', '".$row[4]."', '".$row[5]."', '".$row[6]."', '".$row[7]."')";
    
    $sql = "SELECT email FROM User WHERE email='".$row[2]."'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) 
    {echo "<h1> User: ".$row[2].", già registrato! </h1> ";}
    else
    {
      //Nuovo modo
      // $sql = "INSERT INTO User (firstname, lastname, email, psw, birthday, sesso, username, telefono) VALUES(";
      // for ($i = 0; $i < $n; $i++) 
      // { 
      //   $sql .= "'".$row[$i]."'";
      //   if($i < $n-1)
      //     $sql .= ", ";
      // }
      // $sql .= ")";

      $sql = "INSERT INTO User (firstname, lastname, email, psw, birthday, sesso, username, telefono)
      VALUES ('".$row[0]."', '".$row[1]."', '".$row[2]."', '".md5($row[3])."', '".$row[4]."', '".$row[5]."', '".$row[6]."', '".$row[7]."')";
    

      if (mysqli_query($conn, $sql)) 
      {
        echo "<h1>Registrazione avvenuta con successo!</h1>";

        for ($j=0; $j < $n; $j=$j+2) 
        {   
            echo "<div class=\"divRow\"> ";
            echo "<div class=\"spazio\"> <p class=\"titoli\">". $arrayName[$j] ."<p class=\"field\">".$row[$j]."</p></p></div>";
            echo "<div class=\"spazio\"> <p class=\"titoli\">". $arrayName[$j+1] ."<p class=\"field\">".$row[$j+1]."</p></p></div>";
            echo "</div>";
        }
      } 
    }

    echo "<a id=\"link\" href=\"registra.html\"><input class=\"btnMark\" type=\"button\" value=\"Torna indietro\"></a>";
    echo "</div>";


    echo "<footer align=\"center\">";
    echo "<a id=\"link\" href=\"https://github.com/pallaxx\">";
    echo "<p id=\"nome\"> © – Copyright. - Alex Mazzoni ® - All rights reserved - Registra User™.</p>";
    echo "</a>";
    echo "</footer>";

    // Close connection
    mysqli_close($conn);
    ?>

</body>
</html>