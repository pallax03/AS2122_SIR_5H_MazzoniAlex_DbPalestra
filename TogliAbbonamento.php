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
        $sql = "SELECT IdSubscription FROM subscription WHERE Fk_IdUser = '".$_SESSION["userdata"]['IdUser']."'";
        $result = mysqli_query($conn, $sql);
        mysqli_num_rows($result);
        $id = mysqli_fetch_assoc($result);
        $sql = "DELETE FROM include WHERE Fk_IdSubscription=".$id['IdSubscription']."";

        if (mysqli_query($conn, $sql)) {
          echo "Record deleted successfully";
        } else {
          echo "Error deleting record: " . mysqli_error($conn);
        }

        $sql = "DELETE FROM subscription WHERE Fk_IdUser=".$_SESSION["userdata"]['IdUser']."";

        if (mysqli_query($conn, $sql)) {
          echo "Record deleted successfully";
        } else {
          echo "Error deleting record: " . mysqli_error($conn);
        }
    ?>
</body>
</html>