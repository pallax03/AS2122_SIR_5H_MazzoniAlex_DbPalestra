<?php
    $somma=20;
    $sql = "SELECT * FROM subscription WHERE IdSubscription = '".$rowFindAbb['Fk_IdSubscription']."'";
    $result = mysqli_query($conn, $sql);
    mysqli_num_rows($result);
    while($rowAbbonamenti = mysqli_fetch_assoc($result))
    {
        $sql = "DELETE FROM include WHERE Fk_IdSubscription='".$rowAbbonamenti['IdSubscription']."' and Fk_IdService='".$rowS['IdService'][0]."'";
        mysqli_query($conn, $sql);

        $sql = "SELECT * FROM Include WHERE  Fk_IdSubscription='".$rowAbbonamenti['IdSubscription']."'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0)
        {    
            while($rowServiziScelti = mysqli_fetch_assoc($result))
            {
                $sql = "SELECT Costo FROM Service WHERE IdService = '".$rowServiziScelti['Fk_IdService']."'";
                $result = mysqli_query($conn, $sql);
                mysqli_num_rows($result);
                $row = mysqli_fetch_assoc($result);
                $somma += (int)$row['Costo'];
            }
        }
        $sql = "UPDATE subscription SET Costo='".$somma."' WHERE IdSubscription='".$rowAbbonamenti['IdSubscription']."'";
        mysqli_query($conn, $sql);
    }
?>