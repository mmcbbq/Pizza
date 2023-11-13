<?php

require_once '../vendor/autoload.php';

$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "Pizza";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $pass);
$faker = Faker\Factory::create('de_DE');
$faker->seed(100);

for ($i = 0; $i < 300; $i++) {


    $sql = 'INSERT INTO pizza (groesse) VALUES (:groesse)';

    $groesse = $faker->boolean();

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':groesse', $groesse);
    $stmt->execute();
}
