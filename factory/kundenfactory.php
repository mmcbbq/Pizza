<?php

require_once '../vendor/autoload.php';

$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "Pizza";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $pass);
$faker = Faker\Factory::create('de_DE');
$faker->seed(100);
for ($i = 0; $i < 100; $i++) {


    $sql = 'INSERT INTO kunde (vorname, nachname, plz, ort, strasse, email) VALUES 
                         (:vorname, :nachname, :plz, :ort, :strasse, :email)';
    $stmt = $conn->prepare($sql);
    $vorname = $faker->firstName();
    $nachname = $faker->lastName();
    $plz = $faker->postcode();
    $ort = $faker->city();
    $strasse = $faker->streetAddress();
    $email = $faker->email();

    $stmt->bindParam(':vorname', $vorname);
    $stmt->bindParam(':nachname', $nachname);
    $stmt->bindParam(':plz', $plz);
    $stmt->bindParam(':ort', $ort);
    $stmt->bindParam(':strasse', $strasse);
    $stmt->bindParam(':email', $email);

    $stmt->execute();

}





//print $faker->firstName();
//print $faker->lastName();
//print  $faker->postcode();
//print  $faker->city();
//print  $faker->email();
//print  $faker->streetAddress();
//$faker->boolean();