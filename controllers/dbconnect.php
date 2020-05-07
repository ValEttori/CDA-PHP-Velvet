<!-- Connexions à la base de donnée -->
<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'record';

        // Permet de "tenter" une connection à la base (try) et de retourner une erreur si la connection ne se fait pas (catch).
        try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
	    die( "Connection failed: " . $e->getMessage());
        }

?>