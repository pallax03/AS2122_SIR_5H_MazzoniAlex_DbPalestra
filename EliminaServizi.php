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
        include 'ConnectDb.php';
        $cookie_name = "User";
        if(!isset($_COOKIE[$cookie_name]))//Se il cookie scade allora l'utente dovra' riaccedere
        {
            header('Location: index.php');//AMORE PER QUESTA FUNZIONE
            die(); 
        }

        $nome = $_POST["f0"];

        $sql = "SELECT * FROM Service WHERE Nome='".$nome."'";
        $result = mysqli_query($conn, $sql);
        mysqli_num_rows($result);
        $rowS = mysqli_fetch_assoc($result);
        $sql = "SELECT * FROM Include WHERE Fk_IdService='".$rowS['IdService'][0]."'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0)
        {
            $rowFindAbb = mysqli_fetch_assoc($result);
            include 'AggiornaAbbonamenti.php';
        }

        $sql = "DELETE FROM Service WHERE Nome='".$nome."'";
        mysqli_query($conn, $sql);
            
        mysqli_close($conn);
        
        header('Location: index.php'); //AMORE PER QUESTA FUNZIONE
    ?>
</body>
</html>