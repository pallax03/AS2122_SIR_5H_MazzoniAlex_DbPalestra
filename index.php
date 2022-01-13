<?php
    session_start();
    include_once 'CreateDb.php';
    $cookie_name = "User";
    // setcookie($cookie_name, "", time());
    if(isset($_COOKIE[$cookie_name])){include 'login.php';die();}
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/stylelogin.css">
    <title>Login</title>
</head>
<body>
    <div class="Tavolo">
        <h1>Accedi</h1>
        <form action="login.php" method="POST" name="login">
            
            <input type="text" placeholder="Email" name="f0" required>
            <input type="password" placeholder="Password" name="f1" required>
            <div class="divRow">
                <div class="spazio">
                    <a id="link" href="Recupera.html"><input class="btnMark" type="button" value="Hai dimenticato la Password?"></a>
                </div>
                <div class="spazio">
                    <a id="link" href="Registra.html"><input class="btnMark" type="button" value="Crea il tuo account..."></a>
                </div>
            </div>
            <input class="btnGo" id="myBtn" type="button" value="Accedi" onclick="ValidateData()">
        </form>
    </div>
    <script>
        var input = document.login.f1;
        input.addEventListener("keyup", function(event) {
          if (event.keyCode === 13) {
           event.preventDefault();
           document.getElementById("myBtn").click();
          }
        });
    </script>
    
    <footer align="center" >
        <a id="link" href="https://github.com/pallaxx"><p id="nome"> © – Copyright. - Alex Mazzoni ® - All rights reserved - Login™.</p></a>
    </footer>
    <script src="javascript/script.js"></script>
</body>
</html>