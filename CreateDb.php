<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $Nomedb='dbPalestra';

    //Initializate connection
    $conn = mysqli_connect($servername, $username, $password);

    $sql = "CREATE DATABASE IF NOT EXISTS ".$Nomedb;
    if(!mysqli_query($conn, $sql))
    {
      die("<h1>Error creating Database: ". mysqli_error($conn) ."</h1> ");
    } 

    //Update connection
    $conn = mysqli_connect($servername, $username, $password, $Nomedb);

    //Check connection
    if ($conn->connect_error)
    {
      die("<h1>Connection failed: ". mysqli_connect_error()."</h1> ");
    }
      
    //Create Table
    $sql = "CREATE TABLE IF NOT EXISTS `User` (
	    IdUser	INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    	firstname	VARCHAR(30) NOT NULL,
	    lastname	VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        psw VARCHAR(50) NOT NULL,
        birthday VARCHAR(30) NOT NULL,
        sesso VARCHAR(30) NOT NULL,
        username VARCHAR(30) NOT NULL,
        telefono VARCHAR(30)
    );";
      
    mysqli_query($conn, $sql);
    
    $sql = "CREATE TABLE IF NOT EXISTS `Subscription`(
        IdSubscription INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        DataInizio VARCHAR(30) NOT NULL,
        DataFine VARCHAR(30) NOT NULL,
        Costo VARCHAR(50) NOT NULL,
        Fk_IdUser INT(6) UNSIGNED NOT NULL,
        FOREIGN  KEY (Fk_IdUser) REFERENCES User(IdUser)
    )";

    mysqli_query($conn, $sql);


    $sql = "CREATE TABLE IF NOT EXISTS `Service`(
        IdService INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Nome VARCHAR(30) NOT NULL,
        Costo VARCHAR(30) NOT NULL
    )";
      
    mysqli_query($conn, $sql);


    $sql = "CREATE TABLE IF NOT EXISTS `Include`(
        Fk_IdSubscription INT(6) UNSIGNED NOT NULL,
        Fk_IdService INT(6) UNSIGNED NOT NULL,
        FOREIGN  KEY (Fk_IdSubscription) REFERENCES Subscription(IdSubscription),
        FOREIGN  KEY (Fk_IdService) REFERENCES Service(IdService)
    )";
      
    mysqli_query($conn, $sql);

    ?>