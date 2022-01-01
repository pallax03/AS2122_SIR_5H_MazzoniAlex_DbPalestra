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
    <?php
        session_start();
        include 'CreateDB.php';
        $cookie_name = "User";
        if(!isset($_COOKIE[$cookie_name]))//Se il cookie scade allora l'utente dovra' riaccedere
        {
            header('Location: index.php');//AMORE PER QUESTA FUNZIONE
            die(); 
        }

        if($_SESSION['boolsub'] == 1)
            include 'TogliAbbonamento.php';

        $startdate = $_POST["f0"];
        $finishdate = $_POST["f1"];
        $interessi = isset($_POST['interessi']) ? $_POST['interessi'] : array();
        $somma=20;//per sapere il costo totale dei servizi scelti
        for($i=0; $i<count($interessi);$i++){$somma += (int)$_SESSION['servizi'][$interessi[$i]];}

        //Stampa dati
        echo "<div class=\"Tavolo\"> ";
        $sql = "INSERT INTO subscription (DataInizio, DataFine, Costo, Fk_IdUser)
        VALUES ('".$startdate."', '".$finishdate."', '".$somma."', '".$_SESSION["userdata"]['IdUser']."')";
        mysqli_query($conn, $sql);

        $sql = "SELECT IdSubscription FROM subscription WHERE Fk_IdUser = '".$_SESSION["userdata"]['IdUser']."'";
        $result = mysqli_query($conn, $sql);
        $result->num_rows;
        $id = $result->fetch_assoc();
        for($i=0; $i<count($interessi);$i++)
        {
            $sql = "SELECT * FROM service WHERE Nome = '".$interessi[$i]."'";
            $result = mysqli_query($conn, $sql);
            $result->num_rows;
            $row = $result->fetch_assoc();

            $sql = "INSERT INTO include (Fk_IdSubscription, Fk_IdService)
            VALUES ('".$id['IdSubscription']."', '".$row["IdService"]."')";
            mysqli_query($conn, $sql);
        }

        mysqli_close($conn);
        header('Location: index.php'); //AMORE PER QUESTA FUNZIONE
    ?>
</body>
</html>