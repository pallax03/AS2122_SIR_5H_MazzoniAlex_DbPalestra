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
    include 'CreateDB.php';

    //Stampa dati
    echo "<div class=\"Tavolo\"> ";
      
    $arrayName = ["Nome: ", "Cognome: ", "Email: ", "Password: ", "Data di Nascita: ", "Sesso: ", "Username: ", "Telefono: "];
    $n = count($arrayName);
    for($i=0; $i<$n; $i++)
      $valori[] =$_POST["f".$i];

    //Vecchio modo
    // $sql = "INSERT INTO User (firstname, lastname, email, psw, birthday, sesso, username, telefono)
    //   VALUES ('".$valori[0]."', '".$valori[1]."', '".$valori[2]."', '".$valori[3]."', '".$valori[4]."', '".$valori[5]."', '".$valori[6]."', '".$valori[7]."')";
    
    $sql = "SELECT email FROM User";
    $result = $conn->query($sql);
    $flag = false;
    
    if ($result->num_rows > 0) 
    {
        // output data of each row
        while($row = $result->fetch_assoc()) 
        {
            if($valori[2] == $row["email"])
              $flag=true;
        }
    } 

    if($flag)
    {echo "<h1> User: ".$valori[2].", già registrato! </h1> ";}
    else
    {
      //Nuovo modo
      $sql = "INSERT INTO User (firstname, lastname, email, psw, birthday, sesso, username, telefono) VALUES(";
      for ($i = 0; $i < $n; $i++) 
      { 
        $sql .= "'".$valori[$i]."'";
        if($i < $n-1)
          $sql .= ", ";
      }
      $sql .= ")";

      if ($conn->query($sql) === TRUE) 
      {
        echo "<h1>Registrazione avvenuta con successo!</h1>";

        for ($j=0; $j < $n; $j=$j+2) 
        { 
            echo "<div class=\"divRow\"> ";
            echo "<div class=\"spazio\"> <p class=\"titoli\">". $arrayName[$j] ."<p class=\"field\">".$valori[$j]."</p></p></div>";
            echo "<div class=\"spazio\"> <p class=\"titoli\">". $arrayName[$j+1] ."<p class=\"field\">".$valori[$j+1]."</p></p></div>";
            echo "</div>";
        }
      } 
      else 
      {
        echo "<h1>Error: ". $sql ." ". $conn->error ."</h1> ";
      }
    }

    echo "<a id=\"link\" href=\"index.html\"><input class=\"btnMark\" type=\"button\" value=\"Torna indietro\"></a>";
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