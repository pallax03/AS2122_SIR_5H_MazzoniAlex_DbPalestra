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

        include 'TogliAbbonamento.php';
        
        mysqli_close($conn);
        header('Location: index.php'); //AMORE PER QUESTA FUNZIONE
    ?>
</body>
</html>