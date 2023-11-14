<?php
require_once '../vendor/autoload.php';

$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "Pizza";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $pass);
$faker = Faker\Factory::create('de_DE');
$faker->seed(100);

for ($i = 0; $i < 30; $i++) {


    $sql = 'INSERT INTO topping (name, preis) VALUES (:name, :preis)';

    $name = $faker->word();
    $preis = $faker->randomFloat(2, 0.5, 3);

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':preis', $preis);
    $stmt->execute();

}